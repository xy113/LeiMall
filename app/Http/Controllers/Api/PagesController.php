<?php

namespace App\Http\Controllers\Api;

use App\Models\Pages;

class PagesController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        $pageid = $this->request->input('pageid');
        return ajaxReturn([
            'page'=>Pages::where('pageid', $pageid)->first()
        ]);
    }
}
