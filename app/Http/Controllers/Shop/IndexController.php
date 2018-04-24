<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;

class IndexController extends BaseController
{
    public function index(){

        $shoplist = Shop::where('closed', 0)->paginate(20);
        $this->assign([
            'shoplist'=>$shoplist,
            'pagination'=>$shoplist->links()
        ]);

        return $this->view('shop.index');
    }
}
