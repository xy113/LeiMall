<?php

use App\Http\Controllers\Api\DistrictController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['namespace'=>'Api'], function (){
    Route::any('district/{action}', function (DistrictController $controller, $action){
        return $controller->$action();
    });

    Route::get('/token', 'TokenController@index');

    Route::post('/account/signin', 'AccountController@signin');
    Route::post('/account/signup', 'AccountController@signup');
});
