<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserInfo;
use App\Models\UserStat;
use App\Models\UserStatus;
use Illuminate\Support\Facades\Cookie;

class RegisterController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return $this->view('account.register');
    }

    public function save(){
        $username = $this->request->post('username');
        $mobile   = $this->request->post('mobile');
        $password = $this->request->post('password');

        $group = UserGroup::where('type', 'member')->first();
        $uid = User::insertGetId([
            'gid'=>$group->gid,
            'username'=>$username,
            'mobile'=>$mobile,
            'password'=>encrypt_password($password)
        ]);

        UserStatus::insert([
            'uid'=>$uid,
            'created_at'=>time(),
            'created_ip'=>$this->request->getClientIp(),
            'lastvisit_at'=>time(),
            'lastvisit_ip'=>$this->request->getClientIp(),
            'lastactive'=>time()
        ]);

        UserInfo::insert(['uid'=>$uid]);
        UserStat::insert(['uid'=>$uid]);

        return ajaxReturn(['uid'=>$uid])
            ->cookie(Cookie::forever('uid', $uid))
            ->cookie(Cookie::forever('username', $username));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(){
        $field = $this->request->input('field');
        $value = $this->request->input('value');

        if ($field === 'username'){
            if (User::where('username', $value)->exists()){
                return ajaxError(1, trans('user.username be occupied'));
            }
        }

        if ($field === 'mobile') {
            if (User::where('mobile', $value)->exists()){
                return ajaxError(2, trans('user.mobile be occupied'));
            }
        }

        return ajaxReturn(['return_code'=>0]);
    }
}
