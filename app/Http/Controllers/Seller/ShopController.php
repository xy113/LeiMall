<?php

namespace App\Http\Controllers\Seller;

use App\Models\Item;
use App\Models\Order;
use App\Models\Shop;
use App\Models\ShopAuth;
use App\Models\ShopContent;
use App\Models\Trade;
use Illuminate\Http\Request;

class ShopController extends BaseController
{
    /**
     * ShopController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->assign(['menu'=>'shop_set']);
    }

    /**
     * 店铺首页
     */
    public function index(){

        if ($this->isOnSubmit()){
            $shop = $this->request->post('shop');
            $content = $this->request->post('content');
            if ($shop['shop_name'] && $shop['phone']) {
                if (Shop::where('uid', $this->uid)->exists()) {
                    $shop['updated_at'] = time();
                    Shop::where('uid', $this->uid)->update($shop);
                    ShopContent::where('uid', $this->uid)->update([
                        'content'=>$content,
                        'updated_at'=>time()
                    ]);
                }else {
                    $shop['uid'] = $this->uid;
                    $shop['username'] = $this->username;
                    $shop['created_at'] = time();
                    $shop['auth_status'] = 'PENDING';
                    $shop['closed'] = 1;
                    $shop_id = Shop::insertGetId($shop);

                    ShopContent::insert([
                        'uid'=>$this->uid,
                        'shop_id'=>$shop_id,
                        'content'=>$content,
                        'created_at'=>time()
                    ]);

                }
            }
            return $this->showSuccess(trans('ui.save_succeed'));

        }else {

            $shop = Shop::where('uid', $this->uid)->first();
            $this->assign([
                'shop'=>$shop,
                'content'=>ShopContent::where('shop_id', $shop->shop_id)->first()
            ]);

            return $this->view('seller.shop.index');
        }
    }

    /**
     * 店铺认证
     */
    public function auth(){
        if ($this->isOnSubmit()){
            $auth = $_GET['auth'];
            if ($auth['owner_id'] && $auth['owner_name'] && $auth['id_card_pic_1'] &&
                $auth['id_card_pic_2'] && $auth['id_card_pic_3'] && $auth['license_pic'] && $auth['license_no']){
                $auth['auth_status'] = 'PENDING';
                if (ShopAuth::where('uid', $this->uid)->exists()){
                    $auth['updated_at'] = time();
                    ShopAuth::where('uid', $this->uid)->update($auth);
                }else {
                    $shop = Shop::where('uid', $this->uid)->first();
                    $auth['uid'] = $this->uid;
                    $auth['shop_id'] = $shop->shop_id;
                    $auth['created_at'] = time();
                    ShopAuth::insert($auth);
                }
                return $this->showSuccess(trans('mall.auth_info_submit_success'));
            }else {
                return $this->showError('invalid_parameter');
            }
        }else {

            $shop = Shop::where('uid', $this->uid)->first();
            $auth = ShopAuth::where('uid', $this->uid)->first();
            $this->assign(['auth'=>$auth,'shop'=>$shop]);

            return $this->view('seller.shop.auth');
        }
    }

    /**
     * 店铺实时数据
     */
    public function live_data(){
        $shop = Shop::where('uid', $this->uid)->first();
        $itemCount = Item::where('uid', $this->uid)->count();
        $orderCount = Order::where('seller_uid', $this->uid)->count();
        $payerCount = Trade::where(['payee_uid'=>$this->uid, 'pay_status'=>1])->count();

        $this->assign([
            'shop'=>$shop,
            'itemCount'=>$itemCount,
            'orderCount'=>$orderCount,
            'payerCount'=>$payerCount
        ]);

        return $this->view('seller.shop.live_data');
    }
}
