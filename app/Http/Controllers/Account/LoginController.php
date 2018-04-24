<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Support\Facades\Cookie;

class LoginController extends BaseController
{

    /**
     *
     */
    public function index(){

        $this->assign([
            'redirect'=>$this->request->input('redirect')
        ]);

        return $this->view('account.login');
    }

    /**
     * 验证登录
     */
    public function check(){
        $account  = $this->request->post('account');
        $password = $this->request->post('password');

        $user = User::where('username', $account)->orWhere('email', $account)->orWhere('mobile', $account)->first();
        if ($user) {
            if ($user->password == encrypt_password($password)){
                UserStatus::where('uid', $user->uid)->update([
                    'lastvisit_at'=>time(),
                    'lastvisit_ip'=>$this->request->getClientIp()
                ]);
                return ajaxReturn()->withCookie(Cookie::forever('uid', $user->uid))
                    ->withCookie(Cookie::forever('username', $user->username));
            }else {
                return ajaxError(1, trans('user.password incorrect'));
            }
        }else {
            return ajaxError(2, trans('user.account does not exist'));
        }
    }

    /**
     * AJAX login
     */
    public function ajaxlogin(){
        return $this->view('account.ajaxlogin');
    }
}
