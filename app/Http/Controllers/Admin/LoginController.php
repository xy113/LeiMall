<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Cookie;

class LoginController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(){

        if ($this->request->cookie('adminid')) {
            return redirect()->to('/admin');
        }else {
            return $this->view('admin.login');
        }
    }

    /**
     * 验证登录
     */
    public function checklogin(){
        $account  = $this->request->post('account');
        $password = $this->request->post('password');

        $user = User::where('username', $account)
            ->orWhere('mobile', $account)
            ->orWhere('email', $account)
            ->first();
        if (!$user->admincp){
            return ajaxError(1, trans('member.you are not an administrator'));
        }

        if ($user->password !== encrypt_password($password)){
            return ajaxError(2, trans('member.password incorrect'));
        }

        $uidCookie = Cookie::make('uid', $user->uid);
        $adminidCookie = Cookie::make('adminid', $user->uid);
        $usernameCookie = Cookie::make('username', $user->username);

        return ajaxReturn(['uid'=>$user->uid, 'username'=>$user->username])
            ->cookie($uidCookie)->cookie($adminidCookie)->cookie($usernameCookie);
    }

    /**
     * 退出登录
     */
    public function logout(){
        $cookie = Cookie::forget('adminid');
        return response()->redirectTo('/admin/login')->withCookie($cookie);
    }
}
