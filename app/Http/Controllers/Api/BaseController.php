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
        $this->middleware(function (Request $req, $next){
            $uid = $req->input('uid');
            if ($uid) $this->uid = $uid;

            return $next($req);
        });
    }
}
