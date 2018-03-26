<?php

namespace App\Http\Controllers\Home;

use App\Models\BlockItem;
use App\Models\Job;
use App\Models\MemberArchive;
use App\Models\PostItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return $this->view('home.index');
    }
}
