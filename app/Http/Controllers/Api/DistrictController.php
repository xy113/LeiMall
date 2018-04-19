<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        $id = intval($this->request->input('id'));
        $data = District::where('id', $id)->first();
        return ajaxReturn($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(){
        $fid = intval($this->request->input('fid'));
        $itemlist = District::where('fid', $fid)->orderBy('displayorder')->get();
        return ajaxReturn($itemlist);
    }
}
