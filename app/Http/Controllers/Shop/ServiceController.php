<?php

namespace App\Http\Controllers\Shop;

use App\Models\ShopRecord;

class ServiceController extends BaseController
{
    /**
     * 更新访问记录
     */
    public function update_visit(){
        $shop_id = $this->request->input('shop_id');
        if (ShopRecord::where(['shop_id'=>$shop_id, 'datestamp'=>date('Ymd')])->exists()){
            ShopRecord::where(['shop_id'=>$shop_id, 'datestamp'=>date('Ymd')])->increment('views');
        }else {
            ShopRecord::insert([
                'shop_id'=>$shop_id,
                'datestamp'=>date('Ymd'),
                'views'=>1
            ]);
        }
        return ajaxReturn(['shop_id'=>$shop_id]);
    }
}
