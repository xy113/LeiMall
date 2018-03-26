<?php

namespace App\Http\Controllers\Admin;

class AppController extends BaseController
{
    public function index(){

        return $this->view('admin.common.app');
    }
}
