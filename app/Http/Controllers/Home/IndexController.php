<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Member;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $uids = [];
        Material::groupBy('uid')->get()->map(function ($item) use (&$uids){
            $uids[] = $item->uid;
        });

        Member::whereIn('uid', $uids)->get()->map(function ($m){
            Material::where('uid', $m->uid)->update(['username'=>$m->username]);
        });
        //return $this->view('home.index');
    }
}
