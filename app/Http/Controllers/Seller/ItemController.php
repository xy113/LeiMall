<?php

namespace App\Http\Controllers\Seller;

use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\ItemContent;
use App\Models\ItemImage;
use App\Models\Shop;
use Illuminate\Support\Facades\URL;

class ItemController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){

        if ($this->isOnSubmit()){
            $items = $_GET['items'];
            if ($items && is_array($items)){
                $envetType = $this->request->input('eventType');
                if ($envetType == 'delete'){
                    foreach ($items as $itemid){
                        Item::deleteItem($itemid);
                    }
                    return $this->showSuccess('delete_succeed');
                }

                if ($envetType == 'on_sale'){
                    foreach ($items as $itemid){
                        Item::where(['uid'=>$this->uid, 'itemid'=>$itemid])->update(['on_sale'=>1]);
                    }
                }

                if ($envetType == 'off_sale'){
                    foreach ($items as $itemid){
                        Item::where(['uid'=>$this->uid, 'itemid'=>$itemid])->update(['on_sale'=>0]);
                    }
                }
                return $this->showSuccess('update_succeed');
            }else {
                return $this->showError('no_select');
            }
        }else {

            $condition = ['uid'=>$this->uid];
            $saleStatus = $this->request->input('saleStatus');
            if ($saleStatus === 'off_sale') {
                $condition['on_sale'] = 0;
                $this->assign(['menu'=>'off_sale_item']);
            }else {
                $condition['on_sale'] = 1;
                $this->assign(['menu'=>'on_sale_item']);
            }

            $itemlist = Item::where($condition)->orderByDesc('itemid')->paginate(10);
            $this->assign([
                'saleStatus'=>$saleStatus,
                'pagination'=>$itemlist->appends(['saleStatus'=>$saleStatus])->links(),
                'itemlist'=>$itemlist,
            ]);

            return $this->view('seller.item.list');
        }
    }

    /**
     * 出售宝贝
     */
    public function sell(){

        $itemid = $this->request->input('itemid');
        if ($this->isOnSubmit()){
            $catid = $this->request->input('catid');
            return response()->redirectTo('/seller/item/publish?catid='.$catid.'&itemid='.intval($itemid));
        }else {

            $catlogList = [];
            ItemCatlog::all(['catid', 'fid', 'name'])->map(function ($catlog) use (&$catlogList) {
                 $catlogList[$catlog->fid][] = $catlog;
            });

            $this->assign([
                'catlogList'=>$catlogList,
                'menu'=>'sell'
            ]);

            return $this->view('seller.item.sell');
        }
    }

    /**
     * 发布宝贝
     */
    public function publish(){

        $catid = intval($this->request->get('catid'));
        $itemid = intval($this->request->get('itemid'));
        $this->assign([
            'catid'=>$catid,
            'itemid'=>$itemid
        ]);

        if ($this->isOnSubmit()){
            $item = $this->request->post('item');
            if ($item['title'] && $item['price']){

                //产品图片
                $gallery = $this->request->input('gallery');
                if (isset($gallery[0]['thumb'])){
                    $item['thumb'] = $gallery[0]['thumb'];
                    $item['image'] = $gallery[0]['image'];
                }
                if ($itemid) {
                    $item['updated_at'] = time();
                    Item::where(['uid'=>$this->uid, 'itemid'=>$itemid])->update($item);
                }else {
                    $shop = Shop::where('uid', $this->uid)->first(['shop_id']);
                    $item['uid'] = $this->uid;
                    $item['shop_id'] = $shop->shop_id;
                    $item['created_at'] = time();
                    $itemid = Item::insertGetId($item);
                }

                if ($gallery) {
                    foreach ($gallery as $ga){
                        $id = intval($ga['id']);
                        if ($ga['thumb'] && $ga['image']){
                            if ($id > 0) {
                                ItemImage::where(['id'=>$id, 'uid'=>$this->uid])->update([
                                    'thumb'=>$ga['thumb'],
                                    'image'=>$ga['image']
                                ]);
                            }else {
                                ItemImage::insert([
                                    'uid'=>$this->uid,
                                    'itemid'=>$itemid,
                                    'thumb'=>$ga['thumb'],
                                    'image'=>$ga['image']
                                ]);
                            }
                        }
                    }
                }

                //添加产品介绍
                $content = $this->request->post('content');
                if (ItemContent::where('itemid', $itemid)->exists()){
                    ItemContent::where(['uid'=>$this->uid, 'itemid'=>$itemid])->update([
                        'updated_at'=>time(),
                        'content'=>$content
                    ]);
                }else {
                    ItemContent::insert([
                        'uid'=>$this->uid,
                        'created_at'=>time(),
                        'content'=>$content
                    ]);
                }

                if ($this->request->get('itemid')) {
                    return $this->showSuccess(trans('ui.update_succeed'), null, [
                        ['text'=>trans('common.reedit'), 'url'=>URL::current()],
                        ['text'=>trans('mall.sell_item'), 'url'=>url('/seller/item/sell')],
                        ['text'=>trans('common.back_list'), 'url'=>url('/seller/item/itemlist')],
                    ]);
                }else {
                    return $this->showSuccess(trans('ui.save_succeed'), null, [
                        ['text'=>trans('mall.sell_item'), 'url'=>url('/seller/item/sell')],
                        ['text'=>trans('common.back_list'), 'url'=>url('/seller/item/itemlist')],
                    ]);
                }

            }else {
                return $this->showError('invalid parameter');
            }
        }else {

            $this->assign([
                'menu'=>'sell',
                'item'=>[
                    'title'=>'',
                    'subtitle'=>'',
                    'price'=>0.00,
                    'stock'=>1,
                    'shipping_fee'=>0.00,
                    'on_sale'=>1
                ],
                'content'=>[
                    'content'=>''
                ],
                'gallery'=>[
                    [
                        'id'=>0,
                        'thumb'=>'',
                        'image'=>''
                    ],
                    [
                        'id'=>0,
                        'thumb'=>'',
                        'image'=>''
                    ],
                    [
                        'id'=>0,
                        'thumb'=>'',
                        'image'=>''
                    ],
                    [
                        'id'=>0,
                        'thumb'=>'',
                        'image'=>''
                    ],
                    [
                        'id'=>0,
                        'thumb'=>'',
                        'image'=>''
                    ],
                    'catloglist'=>ItemCatlog::where('catid', $catid)
                        ->orWhere('fid', $catid)->get(['catid', 'name'])
                ]
            ]);

            if ($itemid) {
                $this->assign([
                    'item'=> Item::where(['uid'=>$this->uid,'itemid'=>$itemid])->first(),
                    'content'=>ItemContent::where(['uid'=>$this->uid, 'itemid'=>$itemid])->first(),
                    'gallery'=>ItemImage::where(['uid'=>$this->uid, 'itemid'=>$itemid])->get()
                ]);
            }

            return $this->view('seller.item.publish');
        }
    }
}
