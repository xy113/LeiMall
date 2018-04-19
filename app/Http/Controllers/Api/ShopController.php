<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop;
use App\Models\ShopDesc;

class ShopController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_my_shop(){

        $shop = Shop::where('uid', $this->uid)->first();
        if ($shop) {
            $desc = ShopDesc::where('shop_id', $shop->shop_id)->first();
            $shop->description = $desc->content;
            $shop->shop_logo = image_url($shop->shop_logo);
            $shop->shop_image = image_url($shop->shop_image);
            return ajaxReturn(['shop'=>$shop]);
        }else {
            return ajaxError(1, 'not found');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(){

        $shop = $this->request->input('shop');
        Shop::where('uid', $this->uid)->update($shop);
        return ajaxReturn(['retrun_code'=>0, 'return_msg'=>'success']);
    }
}
