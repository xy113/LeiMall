<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;

class ItemController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        $itemid = $this->request->input('itemid');
        $item = Item::where('itemid', $itemid)->find();
        return ajaxReturn($item);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(){
        $offset = $this->request->input('offset');
        $count = $this->request->input('count');
        $offset = $offset ? $offset : 0;
        $count = $count ? $count : 20;

        $condition = [['on_sale', '=', 1]];
        $catid = $this->request->input('catid');
        if ($catid) $condition[] = ['catid', '=', $catid];

        $totalCount = Item::where($condition)->count();
        $items = Item::where($condition)->offset($offset)->limit($count)
            ->get()->map(function ($item){
                $item->thumb = image_url($item->thumb);
                $item->image = image_url($item->image);
                return $item;
            });
        return ajaxReturn([
            'total_count'=>$totalCount,
            'offset'=>$offset,
            'count'=>$items->count(),
            'items'=>$items
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_my_items(){
        //return ajaxReturn($this->request->input());
        $offset = $this->request->input('offset');
        $count = $this->request->input('count');
        $offset = $offset ? $offset : 0;
        $count = $count ? $count : 20;

        $status = $this->request->input('status');
        $condition = ['uid'=>$this->uid, 'on_sale'=>$status == 'onsale'];

        $totalCount = Item::where($condition)->count();
        $items = Item::where($condition)->offset($offset)->limit($count)
            ->get()->map(function ($item){
                $item->key = "{$item->itemid}";
                $item->thumb = image_url($item->thumb);
                $item->image = image_url($item->image);
                return $item;
        });
        return ajaxReturn([
            'total_count'=>$totalCount,
            'offset'=>$offset,
            'count'=>$items->count(),
            'items'=>$items
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete() {
        $itemid = $this->request->input('itemid');

        if (Item::where(['uid'=>$this->uid, 'itemid'=>$itemid])->exists()){
            //Item::deleteItem($itemid);
        }
        return ajaxReturn([
            'return_code'=>0,
            'return_msg'=>'SUCCESS'
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(){

        $itemid = $this->request->input('itemid');
        $data = $this->request->input('data');

        if ($itemid && !empty($data) && is_array($data)) {
            Item::where(['uid'=>$this->uid, 'itemid'=>$itemid])->update($data);
        }
        return ajaxReturn(['itemid'=>$itemid]);
    }
}
