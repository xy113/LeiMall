<?php

namespace App\Http\Controllers\Item;

use App\Models\ItemCatlog;

class CatlogController extends BaseController
{
    public function index(){

        $this->data['catlogList'] = [];
        ItemCatlog::orderBy('displayorder')->get()->map(function ($catlog){
            $this->data['catlogList'][$catlog->fid][$catlog->catid] = $catlog;
        });

        return $this->view('item.catlog');
    }
}
