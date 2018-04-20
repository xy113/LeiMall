<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;

class SecurityController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function editpass(){
        $oldpass = $this->request->input('oldpass');
        $newpass = $this->request->input('newpass');

        $member = Member::where('uid', $this->uid)->first();
        if ($member->password == encrypt_password($oldpass)){
            Member::where('uid', $this->uid)->update([
                'password'=>encrypt_password($newpass)
            ]);
            return ajaxReturn(['return_code'=>0, 'return_msg'=>'SUCCESS']);
        }else {
            return ajaxError(1, trans('member.password incorrect'));
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindmobile() {
        $mobile = $this->request->input('mobile');
        $member = Member::where([['uid', '<>', $this->uid],['mobile', '=', $mobile]])->first();
        if ($member) {
            return ajaxError(1, trans('member.mobile be occupied'));
        }else {
            Member::where('uid', $this->uid)->update([
                'mobile'=>$mobile
            ]);
            return ajaxReturn(['return_code'=>0, 'return_msg'=>'SUCCESS']);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindemail() {
        $email = $this->request->input('email');
        $member = Member::where([['uid', '<>', $this->uid],['email', '=', $email]])->first();
        if ($member) {
            return ajaxError(1, trans('member.email be occupied'));
        }else {
            Member::where('uid', $this->uid)->update([
                'email'=>$email
            ]);
            return ajaxReturn(['return_code'=>0, 'return_msg'=>'SUCCESS']);
        }
    }
}
