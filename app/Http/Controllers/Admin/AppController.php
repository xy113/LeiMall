<?php

namespace App\Http\Controllers\Admin;

use App\Models\App;

class AppController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){

        if ($this->isOnSubmit()) {
            $items = $this->request->post('items');
            $eventType = $this->request->post('eventType');
            if ($eventType === 'delete') {
                foreach ($items as $id) {
                    App::where('id', $id)->delete();
                }
            }

            if ($eventType === 'enable') {
                foreach ($items as $id) {
                    App::where('id', $id)->update(['app_status'=>'enable']);
                }
            }

            if ($eventType === 'disable') {
                foreach ($items as $id) {
                    App::where('id', $id)->update(['app_status'=>'disable']);
                }
            }
            return ajaxReturn();
        }else {
            $apps = App::orderBy('id','ASC')->paginate(20);
            $this->assign([
                'itemlist'=>$apps,
                'pagination'=>$apps->links()
            ]);

            return $this->view('admin.common.app_list');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(){

        $id = $this->request->get('id');
        if ($this->isOnSubmit()) {
            $app = $this->request->post('app');
            if ($id) {
                $app['updated_at'] = time();
                App::where('id', $id)->update($app);
            }else {
                $app['created_at'] = time();
                App::insert($app);
            }
            return $this->showSuccess(trans('ui.save_succeed'));
        }else {
            $this->assign([
                'id'=>$id,
                'app'=>[
                    'app_id'=>md5_16(random(10)),
                    'app_secret'=>md5(random(10)),
                    'app_name'=>'',
                    'app_version'=>'',
                    'app_url'=>'',
                    'app_status'=>'enable'
                ]
            ]);

            if ($id) {
                $app = App::where('id', $id)->first();
                if ($app) $this->assign(['app'=>$app]);
            }

            return $this->view('admin.common.app_edit');
        }
    }
}
