<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){
        if ($this->isOnSubmit()) {
            $items = $this->request->post('items');
            $eventType = $this->request->post('eventType');

            if ($eventType === 'delete') {
                foreach ($items as $uid) {
                    User::deleteUser($uid);
                }
            }

            if ($eventType === 'allow') {
                foreach ($items as $uid) {
                    User::where('uid', $uid)->update(['status'=>1]);
                }
            }

            if ($eventType === 'forbiden') {
                foreach ($items as $uid) {
                    User::where('uid', $uid)->update(['status'=>-1]);
                }
            }

            return ajaxReturn(['retrun_code'=>0]);
        }else {
            $condition = $queryParams = [];

            $uid = $this->request->input('uid');
            $this->data['uid'] = $uid;
            if ($uid) {
                $condition[] = ['u.uid', '=', $uid];
                $queryParams['uid'] = $uid;
            }

            $username = $this->request->input('username');
            $this->data['username'] = $username;
            if ($username) {
                $condition[] = ['u.username', 'LIKE', $username];
                $queryParams['username'] = $username;
            }

            $mobile = $this->request->input('mobile');
            $this->data['mobile'] = $mobile;
            if ($mobile) {
                $condition[] = ['u.mobile', '=', $mobile];
                $queryParams['mobile'] = $mobile;
            }

            $email = $this->request->input('email');
            $this->data['email'] = $email;
            if ($email) {
                $condition[] = ['u.email', '=', $email];
                $queryParams['email'] = $email;
            }

            $reg_time_begin = $this->request->input('reg_time_begin');
            $this->data['reg_time_begin'] = $reg_time_begin;
            if ($reg_time_begin) {
                $condition[] = ['s.created_at', '>', strtotime($reg_time_begin)];
                $queryParams['reg_time_begin'] = $reg_time_begin;
            }

            $reg_time_end = $this->request->input('reg_time_end');
            $this->data['reg_time_end'] = $reg_time_end;
            if ($reg_time_end) {
                $condition[] = ['s.created_at', '<', strtotime($reg_time_end)];
                $queryParams['reg_time_end'] = $reg_time_end;
            }

            $last_visit_begin = $this->request->input('last_visit_begin');
            $this->data['last_visit_begin'] = $last_visit_begin;
            if ($last_visit_begin) {
                $condition[] = ['s.lastvisit_at', '>', strtotime($last_visit_begin)];
                $queryParams['last_visit_begin'] = $last_visit_begin;
            }

            $last_visit_end = $this->request->input('last_visit_end');
            $this->data['last_visit_end'] = $last_visit_end;
            if ($last_visit_end) {
                $condition[] = ['s.lastvisit_at', '<', strtotime($last_visit_end)];;
                $queryParams['last_visit_end'] = $last_visit_end;
            }

            $users = DB::table('user as u')
                ->leftJoin('user_status as s', 'u.uid', '=', 's.uid')
                ->where($condition)
                ->select('u.*','s.created_at','s.created_ip','s.lastvisit_at','s.lastvisit_ip')
                ->orderBy('uid', 'ASC')
                ->paginate(20);

            $this->assign([
                'pagination'=>$users->appends($queryParams)->links()
            ]);

            $this->data['grouplist'] = [];
            UserGroup::all()->map(function ($group){
                $this->data['grouplist'][$group->gid] = $group;
            });

            $this->data['itemlist'] = [];
            $users->map(function ($user){
                if (isset($this->data['grouplist'][$user->gid])){
                    $user->grouptitle = $this->data['grouplist'][$user->gid]->title;
                }else {
                    $user->grouptitle = '';
                }

                $this->data['itemlist'][$user->uid] = get_object_vars($user);
            });

            $this->assign(['user_status'=>trans('user.user_status')]);
            return $this->view('admin.user.list');
        }
    }

    public function newuser(){

    }
}
