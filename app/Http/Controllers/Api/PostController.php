<?php

namespace App\Http\Controllers\Api;

use App\Models\PostCatlog;
use App\Models\PostItem;

class PostController extends BaseController
{
    public function get_item(){

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget_item(){

        $offset = $this->request->input('offset');
        $count = $this->request->input('count');
        $offset = $offset ? $offset : 0;
        $count = $count ? $count : 20;

        $condition = ['status'=>1];
        $catid = $this->request->input('catid');
        if ($catid) $condition['catid'] = $catid;

        $totalCount = PostItem::where($condition)->count();
        $itemlist = PostItem::where($condition)->offset($offset)->limit($count)->orderByDesc('aid')
            ->get()->map(function ($item) {
                $item->key = "{$item->aid}";
                $item->image = image_url($item->image);
                $item->formatted_time = date('Y-m-d H:i', $item->created_at);
                return $item;
            });

        return ajaxReturn([
            'total_count'=>$totalCount,
            'offset'=>$offset,
            'count'=>$count,
            'items'=>$itemlist
        ]);
    }

    public function get_catlog(){

    }

    public function batchget_catlog(){
        $fid = intval($this->request->input('fid'));
        $condition = ['fid'=>$fid];

        $catloglist = PostCatlog::where($condition)->orderBy('displayorder')->orderBy('catid')
            ->get()->map(function ($catlog){
                $catlog['icon'] = image_url($catlog['icon']);
                return $catlog;
            });

        return ajaxReturn($catloglist);
    }
}
