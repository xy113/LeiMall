<?php

namespace App\Http\Controllers\Item;

use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\ItemContent;
use App\Models\ItemImage;
use App\Models\Shop;

class DetailController extends BaseController
{
    public function index($itemid) {

        Item::where('itemid', $itemid)->increment('views');
        $iteminfo = Item::where('itemid', $itemid)->first();
        if (!$iteminfo) {

        }else {
            $this->assign(['iteminfo'=>$iteminfo, 'itemid'=>$itemid]);

            $content = ItemContent::where('itemid', $itemid)->first();
            $this->assign(['content'=>$content]);

            $gallery = ItemImage::where('itemid', $itemid)->orderBy('displayorder')->get();
            if (!$gallery) {
                $gallery = [
                    [
                        'thumb'=>$iteminfo['thumb'],
                        'image'=>$iteminfo['image']
                    ]
                ];
            }
            $this->assign(['gallery'=>$gallery]);

            $shop = Shop::where('shop_id', $iteminfo['shop_id'])->first();
            $this->assign(['shop'=>$shop]);

            $catlog = ItemCatlog::where('catid', $iteminfo['catid'])->first();
            $this->assign(['catlog'=>$catlog]);

            //掌柜热卖
            $hotSaleList = Item::where(['shop_id'=>$iteminfo['shop_id'],'on_sale'=>1])->orderByDesc('sold')->limit(5)->get();
            $this->assign(['hotSaleList'=>$hotSaleList]);

            return $this->view('item.detail');
        }
    }
}
