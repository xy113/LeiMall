<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserGroup;

class UserGroupController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){
        if ($this->isOnSubmit()){
            $delete = $this->request->post('delete');
            if ($delete) {
                foreach ($delete as $gid) {
                    UserGroup::where('gid', $gid)->delete();
                }
            }

            $grouplist = $this->request->post('grouplist');
            if ($grouplist) {
                foreach ($grouplist as $gid=>$group){
                    if ($group['title']) {
                        if ($gid > 0) {
                            UserGroup::where('gid', $gid)->update($group);
                        }else {
                            UserGroup::insert($group);
                        }
                    }
                }
            }
            return $this->showSuccess(trans('ui.update_succeed'));
        }else {

            $this->data['grouplist'] = [];
            UserGroup::all()->map(function ($g){
                $this->data['grouplist'][$g->type][$g->gid] = $g;
            });

            return $this->view('admin.user.group');
        }
    }
}
