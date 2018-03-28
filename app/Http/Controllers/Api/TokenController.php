<?php

namespace App\Http\Controllers\Api;

use App\Models\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $appid = $this->request->input('appid');
        $secret = $this->request->input('secret');

        $app = App::where(['app_id'=>$appid, 'app_secret'=>$secret])->first();
        if ($app) {
            $data = [
                'token'=>md5(time().random(10)),
                'expire_in'=>time()+7200
            ];
            App::where(['app_id'=>$appid])->update($data);
            return ajaxReturn($data);
        }else {
            return ajaxError(1, 'appid not exists');
        }
    }
}
