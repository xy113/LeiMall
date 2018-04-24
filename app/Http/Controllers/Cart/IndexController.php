<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use App\Models\Collection;
use App\Models\Item;
use App\Models\Shop;

class IndexController extends BaseController
{

    /**
     *
     */
    public function index(){

        $itemlist = [];
        Cart::where('uid', $this->uid)->get()->map(function ($item) use (&$itemlist){
            if (!isset($itemlist[$item->shop_id])) {
                $itemlist[$item->shop_id] = [
                    'shop_id'=>$item->shop_id,
                    'shop_name'=>$item->shop_name,
                    'items'=>[]
                ];

                $itemlist[$item->shop_id]['items'][$item->itemid] = $item;
            }

        });
        $this->assign([
            'itemlist'=>$itemlist,
            'totalCount'=>Cart::where('uid', $this->uid)->count()
        ]);

        return $this->view('cart.index');
    }

    /**
     * 添加购物车
     */
    public function add(){
        $itemid = intval($this->request->input('itemid'));
        $quantity = intval($this->request->input('quantity'));

        $item = Item::where('itemid', $itemid)->first();
        if ($item) {
            if (Cart::where(['uid'=>$this->uid, 'itemid'=>$itemid])->exists()){
                Cart::where(['uid'=>$this->uid, 'itemid'=>$itemid])->increment('quantity');
            }else {
                $shop = Shop::where('shop_id', $item->shop_id)->first();
                Cart::insert([
                    'uid'=>$this->uid,
                    'itemid'=>$itemid,
                    'quantity'=>$quantity,
                    'shop_id'=>$shop->shop_id,
                    'shop_name'=>$shop->shop_name,
                    'title'=>$item->title,
                    'price'=>$item->price,
                    'thumb'=>$item->thumb,
                    'image'=>$item->image,
                    'createa_at'=>time()
                ]);
            }
            return ajaxReturn([
                'return_code'=>0,
                'return_msg'=>'SUCCESS'
            ]);
        }else {
            return ajaxError(404, 'item not exists');
        }
    }

    /**
     * AJAX删除宝贝
     * @throws \Exception
     */
    public function delete(){

        $items = $this->request->post('items');
        if ($items) {
            foreach (explode(',', $items) as $itemid){
                Cart::where(['uid'=>$this->uid, 'itemid'=>$itemid])->delete();
            }
        }
        return ajaxReturn([
            'return_code'=>0,
            'return_msg'=>'SUCCESS'
        ]);
    }

    /**
     * 更新商品数量
     */
    public function update_quantity(){
        $itemid = intval($this->request->input('itemid'));
        $quantity = intval($this->request->input('quantity'));

        Cart::where(['uid'=>$this->uid, 'itemid'=>$itemid])->update(['quantity'=>$quantity]);

        return ajaxReturn([
            'return_code'=>0,
            'return_msg'=>'SUCCESS'
        ]);
    }

    /**
     * 移动到收藏夹
     */
    public function move_to_favor(){
        $items = $this->request->input('items');
        if ($items) {
            Cart::where('uid', $this->uid)->whereIn('itemid', $items)
                ->get()->map(function ($item){
                    if (!Collection::where(['uid'=>$this->uid, 'datatype'=>'item', 'dataid'=>$item->itemid])->exists()){
                        Collection::insert([
                            'uid'=>$this->uid,
                            'dataid'=>$item->itemid,
                            'datatype'=>'item',
                            'title'=>$item->title,
                            'image'=>$item->thumb,
                            'created_at'=>time()
                        ]);
                    }
                    Cart::where(['uid'=>$this->uid, 'itemid'=>$item->itemid])->delete();
                });
        }
        return ajaxReturn([
            'return_code'=>0,
            'return_msg'=>'SUCCESS'
        ]);
    }
}
