<?php

namespace App\Http\Controllers\Seller;

use App\Models\Order;
use App\Models\PostItem;
use App\Models\Shop;
use App\Models\Wallet;

class IndexController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $this->assign([
            'shop' => Shop::where('uid', $this->uid)->first(),
            'wallet' => Wallet::getData($this->uid),
            'waitPayCount'=>Order::where(['seller_uid'=>$this->uid,'pay_status'=>0])->count(),
            'waitSendCount'=>Order::where(['seller_uid'=>$this->uid,'pay_status'=>1, 'shipping_status'=>0])->count(),
            'postList'=>PostItem::where(['status'=>1])->limit(6)->orderByDesc('aid')->get()
        ]);

        return $this->view('seller.index');
    }
}
