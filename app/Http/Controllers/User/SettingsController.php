<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserInfo;
use Intervention\Image\Facades\Image;

class SettingsController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userinfo(){
        if ($this->isOnSubmit()) {
            $userinfo = $this->request->post('userinfo');
            UserInfo::where('uid', $this->uid)->update($userinfo);
            return $this->showSuccess(trans('ui.update_succeed'));
        }else {
            $this->assign([
                'menu'=>'userinfo',
                'userinfo'=>UserInfo::where('uid', $this->uid)->first(),
                'sex_items'=>trans('user.sex_items')
            ]);

            return $this->view('user.settings.userinfo');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function security(){
        if ($this->isOnSubmit()) {

        }else {
            $this->assign([
                'menu'=>'security',
                'user'=>User::where('uid', $this->uid)->first(),
            ]);

            return $this->view('user.settings.security');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar(){

        ignore_user_abort(true);
        $avatarPath = storage_public_path('avatar/'.$this->uid);
        @mkdir($avatarPath, 0777, true);
        $source = storage_public_path($this->request->file('file')->store('tmp'));

        $image  = Image::make($source);
        $width  = $image->width();
        $height = $image->height();
        if ($width > $height) {
            $x = ($width - $height)/2;
            $image = $image->crop($height, $height, intval($x), 0);
        }else {
            $y = ($height - $width)/2;
            $image = $image->crop($width, $width, 0, intval($y));
        }

        $image->resize(300, 300)->save($avatarPath.'/big.png');
        $image->resize(150, 150)->save($avatarPath.'/middle.png');
        $image->resize(50, 50)->save($avatarPath.'/small.png');
        @unlink($source);

        return ajaxReturn(['return_code'=>0, 'return_msg'=>'SUCCESS']);
    }
}
