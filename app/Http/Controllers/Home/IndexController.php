<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return $this->view('home.index');
    }
}
