<?php

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

    Route::get('/district/get', 'DistrictController@get');
    Route::get('/district/batchget', 'DistrictController@batchget');

    Route::get('/token', 'TokenController@index');
    Route::get('/token/check', 'TokenController@check');

    Route::any('/account/signin', 'AccountController@signin');
    Route::any('/account/signup', 'AccountController@signup');

    //item
    Route::any('/item/get', 'ItemController@get');
    Route::any('/item/batchget', 'ItemController@batchget');
    Route::any('/item/save', 'ItemController@save');
    Route::any('/item/delete', 'ItemController@delete');
    Route::any('/item/get_my_items', 'ItemController@get_my_items');
    Route::any('/item/get_catlog', 'ItemController@get_catlog');
    Route::any('/item/batchget_catlog', 'ItemController@batchget_catlog');

    //post
    Route::any('/post/batchget_item', 'PostController@batchget_item');
    Route::any('/post/batchget_catlog', 'PostController@batchget_catlog');

    //order
    Route::any('/order/get_sold_items', 'OrderController@get_sold_items');
    Route::any('/order/get_sold_order', 'OrderController@get_sold_order');
    Route::any('/order/send', 'OrderController@send');

    //express
    Route::any('/express/batchget', 'ExpressController@batchget');
    //pages
    Route::any('/pages/get', 'PagesController@get');
    //feedback
    Route::any('/feedback/save', 'FeedbackController@save');
    //shop
    Route::any('/shop/get_my_shop', 'ShopController@get_my_shop');
    Route::any('/shop/save', 'ShopController@save');

    //material
    Route::any('/material/upload_img', 'MaterialController@upload_img');

    //security
    Route::any('/security/editpass', 'SecurityController@editpass');
    Route::any('/security/bindmobile', 'SecurityController@bindmobile');
    Route::any('/security/bindemail', 'SecurityController@bindemail');

    //version
    Route::any('/version', function (){
        return ajaxReturn(['version'=>1.0]);
    });
});
