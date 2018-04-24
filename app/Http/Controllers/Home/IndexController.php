<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlockItem;
use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\Material;
use App\Models\Member;
use App\Models\PostItem;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $this->assign([
            'newsList'=>PostItem::where(['status'=>1])->limit(12)->orderByDesc('aid')->get(),
            'shopList'=>Shop::where(['closed'=>0])->limit(10)->get(),
            'youxuanList'=>DB::table('item_push AS p')
                ->leftJoin('item AS i', 'i.itemid', '=', 'p.itemid')
                ->where(['p.groupid'=>3,'i.on_sale'=>1])->orderByDesc('p.id')->limit(5)->get(['i.*'])
                ->map(function ($item){
                    return get_object_vars($item);
                }),
            'recommendList'=>DB::table('item_push AS p')
                ->leftJoin('item AS i', 'i.itemid', '=', 'p.itemid')
                ->where(['p.groupid'=>1,'i.on_sale'=>1])->orderByDesc('p.id')->limit(50)->get(['i.*'])
                ->map(function ($item){
                    return get_object_vars($item);
                }),
            'hotSales'=>Item::where(['on_sale'=>1])->orderByDesc('sold')->limit(5)->get(),
            //幻灯
            'slideList'=>BlockItem::where('block_id', 1)->orderBy('displayorder')->limit(5)->get(),
            //推荐
            'bestList'=>BlockItem::where('block_id', 2)->orderBy('displayorder')->limit(5)->get(),
        ]);

        $this->data['catlogList'] = [];
        ItemCatlog::orderBy('displayorder')->get()->map(function ($catlog){
            $this->data['catlogList'][$catlog->fid][$catlog->catid] = $catlog;
        });

        return $this->view('home.index');
    }
}
