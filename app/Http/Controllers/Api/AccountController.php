<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\MemberLog;
use App\Models\MemberSession;
use App\Models\MemberStatus;

class AccountController extends BaseController
{
    public function signin(){
        $account = $this->request->input('account');
        $password = $this->request->input('password');

        $member = Member::where('username', $account)->orWhere('email', $account)->orWhere('mobile', $account)->first();
        if ($member) {
            if ($member->password !== encrypt_password($password)) {
                return ajaxError(2, trans('member.password incorrect'));
            }

            //更新状态
            MemberStatus::where('uid', $this->uid)->update([
                'lastvisit'=>time(),
                'lastvisitip'=>$this->request->getClientIp()
            ]);

            //记录日志
            MemberLog::insert([
                'uid'=>$member->uid,
                'ip'=>$this->request->getClientIp(),
                'operate'=>'login',
                'created_at'=>time()
            ]);

            $userinfo = [
                'uid'=>$member->uid,
                'username'=>$member->username,
                'email'=>$member->email,
                'mobile'=>$member->mobile
            ];
            $session_id = md5(time().rand(100, 999));
            if (!MemberSession::where('uid', $member->uid)->update([
                'session_id'=>$session_id,
                'session_value'=>serialize($userinfo),
                'expires_in'=>time()
            ])){
                MemberSession::insert([
                    'uid'=>$member->uid,
                    'session_id'=>$session_id,
                    'session_value'=>serialize($userinfo),
                    'expires_in'=>time()
                ]);
            }
            $userinfo['avatar'] = avatar($member->uid);
            $userinfo['session_id'] = $session_id;

            return ajaxReturn(['userinfo'=>$userinfo]);
        }else {
            return ajaxError(1, trans('member.account does not exist'));
        }
    }

    public function signup(){

    }
}
