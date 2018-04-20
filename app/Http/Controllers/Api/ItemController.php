<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\ItemDesc;
use App\Models\ItemImage;
use App\Models\Shop;

class ItemController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        $itemid = $this->request->input('itemid');
        $item = Item::where('itemid', $itemid)->first();
        if ($item) {
            $item->imageurl = image_url($item->image);
            $item->thumburl = image_url($item->thumb);
            $item->images = ItemImage::where('itemid', $itemid)->get()->map(function ($img){
                $img->thumburl = image_url($img->thumb);
                $img->imageurl = image_url($img->image);
                return $img;
            });
            $item->description = ItemDesc::where('itemid', $itemid)->first();
            $item->catlog = ItemCatlog::where('catid', $item->catid)->first();
            return ajaxReturn(['item'=>$item]);
        }else {
            return ajaxError(404, 'item not exists');
        }
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
                $item->thumburl = image_url($item->thumb);
                $item->imageurl = image_url($item->image);
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
                $item->thumburl = image_url($item->thumb);
                $item->imageurl = image_url($item->image);
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
     * @throws \Exception
     */
    public function save(){
        //return ajaxReturn($this->request->post());
        $itemid = $this->request->input('itemid');
        $item   = $this->request->input('item');
        $images = $this->request->input('images');
        $description = $this->request->input('description');

        //更新商品信息
        if ($item && is_array($item)) {
            if ($itemid) {
                if (Item::where(['uid'=>$this->uid, 'itemid'=>$itemid])->exists()) {
                    $item['updated_at'] = time();
                    Item::where(['uid'=>$this->uid, 'itemid'=>$itemid])->update($item);
                }else{
                    return ajaxError(1, 'item not exists');
                }

            }else {
                $shop = Shop::where('uid', $this->uid)->first(['shop_id', 'shop_name']);
                if ($shop) {
                    $item['shop_id'] = $shop->shop_id;
                }

                $item['uid'] = $this->uid;
                $item['created_at'] = time();
                $item['item_sn'] = createItemSn();
                $itemid = Item::insertGetId($item);
            }
        }

        //更新图片
        if (is_array($images)) {
            $imageList = [];
            ItemImage::where('itemid', $itemid)->get()->map(function ($img) use (&$imageList){
                $imageList[$img->id] = [
                    'mark' => 'delete',
                    'image' => $img
                ];
            });

            $itemImage = $newImageList = [];
            foreach ($images as $img) {
                if (!$itemImage) $itemImage = $img;
                if (isset($img['id'])) {
                    if (isset($imageList[$img['id']])) {
                        $imageList[$img['id']]['mark'] = 'update';
                        $newImageList[] = [
                            'id'=>$img['id'],
                            'mark' => 'update',
                            'image' => [
                                'thumb'=>$img['thumb'],
                                'image'=>$img['image']
                            ]
                        ];
                    }
                }else {
                    $newImageList[] = [
                        'id'=>0,
                        'mark' => 'insert',
                        'image' => [
                            'thumb'=>$img['thumb'],
                            'image'=>$img['image'],
                            'uid'=>$this->uid,
                            'itemid'=>$itemid
                        ]
                    ];
                }
            }

            if ($newImageList) {
                foreach ($newImageList as $image) {
                    if ($image['mark'] === 'update') {
                        ItemImage::where('id', $image['id'])->update($image['image']);
                    }else {
                        ItemImage::insert($image['image']);
                    }
                }
            }

            if ($imageList) {
                foreach ($imageList as $id=>$image) {
                    if ($image['mark'] === 'delete') {
                        ItemImage::where('id', $id)->delete();
                    }
                }
            }

            if ($itemImage) {
                Item::where('itemid', $itemid)->update([
                    'thumb'=>$itemImage['thumb'],
                    'image'=>$itemImage['image']
                ]);
            }
        }

        //更新宝贝详情
        if (is_array($description)) {
            if (ItemDesc::where('itemid', $itemid)->exists()){
                ItemDesc::where('itemid', $itemid)->update([
                    'content'=>$description['content'],
                    'updated_at'=>time()
                ]);
            }else {
                ItemDesc::insert([
                    'uid'=>$this->uid,
                    'itemid'=>$itemid,
                    'content'=>$description['content'],
                    'created_at'=>time()
                ]);
            }
        }

        return ajaxReturn(['itemid'=>$itemid]);

    }

    //
    public function get_catlog(){
        $catid = $this->request->input('catid');
        if ($catid) {
            $catlog = ItemCatlog::where('catid', $catid)->first();
            return ajaxReturn(['catlog'=>$catlog]);
        }else {
            return ajaxError(404, 'catlog not exists');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget_catlog(){
        $fid = intval($this->request->input('fid'));

        $items = ItemCatlog::where('fid', $fid)->get()->map(function ($catlog){
            $catlog->icon = image_url($catlog->icon);
            return $catlog;
        });
        return ajaxReturn(['items'=>$items]);
    }
}
