<?php

namespace App\Http\Controllers\Shop;

use App\Models\Item;
use App\Models\Shop;

class ViewShopController extends BaseController
{
    public function index($shop_id){

        Shop::where('shop_id', $shop_id)->increment('views');
        $shop = Shop::where('shop_id', $shop_id)->orWhere('uid', $shop_id)->first();

        if (!$shop) {
            //
        }else {
            $this->assign([
                'shop_id'=>$shop_id,
                'shop'=>$shop
            ]);
            //掌柜热卖
            $hotSaleList = Item::where(['shop_id'=>$shop_id, 'on_sale'=>1])->orderByDesc('sold')->limit(6)->get();
            $this->assign(['hotSaleList'=>$hotSaleList]);

            $itemList = Item::where(['shop_id'=>$shop_id, 'on_sale'=>1])->paginate(12);
            $this->assign([
                'itemlist'=>$itemList,
                'pagination'=>$itemList->links()
            ]);

            return $this->view('shop.viewshop');
        }
    }
}
