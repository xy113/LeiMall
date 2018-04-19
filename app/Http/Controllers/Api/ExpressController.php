<?php

namespace App\Http\Controllers\Api;

use App\Models\Express;

class ExpressController extends BaseController
{
    public function batchget(){
        $express = Express::all()->map(function ($item){
            $item->key = "$item->id";
            return $item;
        });

        return ajaxReturn([
            'total_count'=>$express->count(),
            'items'=>$express
        ]);
    }
}
