<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Pinyin;
use App\Models\PostCatlog;
use App\Models\PostItem;

class PostCatlogController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){

        if ($this->isOnSubmit()) {
            $catloglist = $this->request->input('catloglist');
            if ($catloglist) {
                $pinyin = new Pinyin();
                foreach ($catloglist as $catid=>$catlog) {
                    if ($catlog['name']) {
                        if (!$catlog['identifier']) {
                            $catlog['identifier'] = $pinyin->getPinyin($catlog['name']);
                        }
                        PostCatlog::where('catid', $catid)->update($catlog);
                    }
                }
                PostCatlog::updateCache();
            }
            return $this->showSuccess(trans('ui.save_succeed'));
        }else {
            $this->data['catloglist'] = PostCatlog::getTree(false);
            return $this->view('admin.post.catlogs');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function newcatlog(){

        $catid = $this->request->input('catid');
        if ($this->isOnSubmit()){
            $catlog = $this->request->post('catlog');
            if ($catid) {
                PostCatlog::where('catid', $catid)->update($catlog);
            }else {
                PostCatlog::insert($catlog);
            }
            PostCatlog::updateCache();
            return $this->showSuccess(trans('ui.save_succeed'));
        }else {
            $this->assign([
                'catid'=>$catid,
                'catlog'=>[
                    'name'=>'',
                    'fid'=>0,
                    'available'=>1,
                    'template_index'=>'',
                    'template_list'=>'',
                    'template_detail'=>'',
                    'keywords'=>'',
                    'description'=>''
                ],
                'catloglist'=>[]
            ]);

            if ($catid) {
                $this->assign([
                    'catlog'=>PostCatlog::where('catid', $catid)->first()
                ]);
            }

            $this->data['catloglist'] = PostCatlog::getTree();

            return $this->view('admin.post.newcatlog');
        }
    }

    /**
     * 删除分类
     * @throws \Exception
     */
    public function delete(){
        $catid = $this->request->input('catid');
        if ($this->isOnSubmit()) {
            $moveto = $this->request->post('moveto');
            $deleteChilds = $this->request->post('deleteChilds');

            if ($moveto || $deleteChilds) {
                $childIds = PostCatlog::getAllChildIds($catid);
                foreach ($childIds as $catid){
                    PostCatlog::where('catid', $catid)->delete();
                }

                foreach (PostItem::whereIn('catid', $childIds)->get(['aid']) as $item){
                    PostItem::deleteAll($item->aid);
                }
            }else {

                $childIds = PostCatlog::getAllChildIds($catid);
                PostItem::whereIn('catid', $childIds)->update(['catid'=>$moveto]);

                PostCatlog::where('catid', $catid)->delete();
            }

            PostCatlog::updateCache();
            return $this->showSuccess(trans('ui.update_succeed'));
        }else {

            $this->assign([
                'catid'=>$catid,
                'catlog'=>PostCatlog::where('catid', $catid)->first(),
                'catloglist'=>PostCatlog::getTree(false)
            ]);

            return $this->view('admin.post.deletecatlog');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function merge(){
        if ($this->isOnSubmit()) {
            $target = $this->request->post('target');
            $source = $this->request->post('source');
            if ($source) {
                foreach ($source as $catid) {
                    PostItem::where('catid', $catid)->update(['catid'=>$target]);
                    PostCatlog::where('catid', $catid)->delete();
                }
                PostCatlog::updateCache();
            }
            return $this->showSuccess(trans('ui.update_succeed'), '', [
                array('text'=>trans('common.back_list'), 'url'=>url('/admin/postcatlog'))
            ]);
        }else {

            $this->data['catloglist'] = PostCatlog::getTree(false);
            return $this->view('admin.post.merge');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function seticon(){
        $catid = $this->request->post('catid');
        $icon = $this->request->post('icon');
        if ($catid && $icon){
            PostCatlog::where('catid', $catid)->update(['icon'=>$icon]);
            PostCatlog::updateCache();
        }
        return ajaxReturn();
    }
}
