<?php

namespace App\Http\Controllers\User;

use App\Models\Wallet;

class IndexController extends BaseController
{
    public function index(){

        $this->assign([
            'wallet'=>Wallet::getData($this->uid)
        ]);

        return $this->view('user.index');
    }
}
