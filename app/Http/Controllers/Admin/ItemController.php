<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\ItemCatlog;
use Illuminate\Support\Facades\DB;

class ItemController extends BaseController
{
    /**
     * 商品列表
     * @throws \Exception
     */
    public function index(){

        if ($this->isOnSubmit()) {
            $items = $this->request->post('items');
            $eventType = $this->request->post('eventType');
            if ($items && is_array($items)) {

                if ($eventType == 'delete'){
                    foreach ($items as $itemid) {
                        Item::deleteItem($itemid);
                    }
                }

                if ($eventType == 'on_sale'){
                    foreach ($items as $itemid) {
                        Item::where('itemid', $itemid)->update(['on_sale'=>1]);
                    }
                }

                if ($eventType == 'off_sale'){
                    foreach ($items as $itemid) {
                        Item::where('itemid', $itemid)->update(['on_sale'=>0]);
                    }
                }
                //移动文章
                if ($eventType == 'move'){
                    $this->move();
                    exit();
                }
                return ajaxReturn(['return_code'=>0]);
            }else {
                return ajaxError(1, trans('no_select'));
            }
        }else {

            $condition = $queryParams = [];

            $shop_name = $this->request->input('shop_name');
            $this->assign(['shop_name'=>$shop_name]);
            if ($shop_name) {
                $condition[] = ['s.shop_name', 'LIKE', "%$shop_name%"];
                $queryParams['shop_name'] = $shop_name;
            }

            $seller_name = $this->request->get('seller_name');
            $this->assign(['seller_name'=>$seller_name]);
            if ($seller_name) {
                $condition[] = ['s.username', 'LIKE', "%$seller_name%"];
                $queryParams['seller_name'] = $seller_name;
            }

            $sale_status = $this->request->get('sale_status');
            $this->assign(['sale_status'=>$sale_status]);
            if ($sale_status) {
                if ($sale_status == 'on_sale'){
                    $condition[] = ['i.on_sale', 1];
                }
                if ($sale_status == 'off_sale'){
                    $condition[] = ['i.on_sale', 0];
                }
                $queryParams['sale_status'] = $sale_status;
            }

            $title = $this->request->get('title');
            $this->assign(['title'=>$title]);
            if ($title) {
                $condition[] = ['i.title', 'LIKE', "%$title%"];
                $queryParams['title'] = $title;
            }

            $min_price = $this->request->get('min_price');
            $max_price = $this->request->get('max_price');
            $this->assign([
                'min_price'=>$min_price,
                'max_price'=>$max_price
            ]);
            if ($min_price) {
                $min_price = floatval($min_price);
                $condition[] = ['i.price', '>', $min_price];
                $queryParams['min_price'] = $min_price;
            }

            if ($max_price) {
                $max_price = floatval($max_price);
                $condition[] = ['i.price', '<', $max_price];
                $queryParams['max_price'] = $max_price;
            }

            $itemid = $this->request->get('itemid');
            $this->assign(['itemid'=>$itemid]);
            if ($itemid) {
                $condition[] = ['i.itemid', $itemid];
                $queryParams['itemid'] = $itemid;
            }

            $catid = $this->request->get('catid');
            $this->assign(['catid'=>$catid]);
            if ($catid) {
                $condition[] = ['catid', $catid];
                $queryParams['catid'] = $catid;
            }

            $itemlist = DB::table('item AS i')
                ->leftJoin('shop AS s', 's.shop_id', '=', 'i.shop_id')
                ->where($condition)->orderByDesc('i.itemid')->select(['i.*','s.shop_name'])->paginate(20);
            $this->assign([
                'pagination'=>$itemlist->appends($queryParams)->links(),
                'itemlist'=>$itemlist->map(function ($item){
                    return get_object_vars($item);
                })
            ]);

            $this->data['catloglist'] = [];
            $this->data['catlognames'] = [];
            ItemCatlog::select(['catid','fid','name'])->get()->map(function ($catlog){

                $this->data['catloglist'][$catlog->fid][$catlog->catid] = $catlog;
                $this->data['catlognames'][$catlog->catid] = $catlog->name;
            });

            return $this->view('admin.item.list');
        }
    }

    /**
     * 移动商品
     */
    public function move(){
        global $_G,$_lang;

        if ($this->checkFormSubmit()) {
            $items = $_GET['items'];
            $catid = intval($_GET['catid']);
            if ($items && $catid) {
                $itemModel = new ItemModel();
                foreach (explode(',', $items) as $itemid){
                    $itemModel->where(array('itemid'=>$itemid))->data(array('catid'=>$catid))->save();
                }
            }
            $this->showSuccess('update_succeed', null, array(
                array('text'=>'back_list', 'url'=>U('c=item&a=index'))
            ));
        }else {

            $items = $_GET['items'];
            $items = is_array($items) ? implode(',', $items) : $items;
            $catloglist = (new ItemCatlogModel())->getCatlogTree();

            include view('item/item_move');
        }
    }
}
