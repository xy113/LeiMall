<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * BaseController constructor.
     * @param Request $request
     */
    function __construct(Request $request)
    {
        parent::__construct($request);

        $this->uid = 0;
        $this->username = '';
        $this->data = [
            'uid'=>0,
            'username'=>''
        ];

        $this->middleware(function (Request $req, $next){
            $session = $req->input('__session');
            if (is_array($session)) {
                $this->uid = $session['uid'];
                $this->username = $session['username'];
                $this->assign([
                    'uid'=>$this->uid,
                    'username'=>$this->username
                ]);
            }

            return $next($req);
        });
    }
}
