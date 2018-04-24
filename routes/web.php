<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/youxuan', 'YouxuanController@index');
});

Route::group(['namespace' => 'Shop', 'prefix'=>'shop'], function (){
    Route::get('/', 'IndexController@index');
    Route::get('/{shopid}.html', 'ViewShopController@index');
});

Route::group(['namespace' => 'Item', 'prefix'=>'item'], function (){
    Route::get('/search', 'SearchController@index');
    Route::get('/detail/{itemid}.html', 'DetailController@index');
    Route::get('/list/{catid}.html', 'ListController@index');
    Route::any('/service/update_visit', 'Shop\ServiceController@update_visit');
    Route::any('/catlog', 'CatlogController@index');
});

Route::group(['namespace'=>'User', 'prefix'=>'user'], function (){
    Route::get('/', 'IndexController@index');
    //Settings
    Route::any('/settings/userinfo', 'SettingsController@userinfo');
    Route::any('/settings/security', 'SettingsController@security');
    Route::any('/settings/avatar', 'SettingsController@avatar');
    //Order
    Route::any('/order', 'OrderController@index');
    //Wallet
    Route::any('/wallet', 'WalletController@index');
    //address
    Route::any('/address', 'AddressController@index');
    Route::any('/address/setdefault', 'AddressController@setdefault');
    Route::any('/address/delete', 'AddressController@delete');
    //collection
    Route::any('/collection', 'CollectionController@index');
    Route::any('/collection/delete', 'CollectionController@delete');
});

Route::group(['namespace'=>'Seller', 'prefix'=>'seller'], function (){
    Route::get('/', 'IndexController@index');
    Route::any('/shop', 'ShopController@index');
    Route::any('/shop/auth', 'ShopController@auth');
    Route::any('/shop/live_data', 'ShopController@live_data');
    //analyse
    Route::get('/analyse', 'AnalyseController@index');
    //item
    Route::get('/item/itemlist', 'ItemController@index');
    Route::any('/item/sell', 'ItemController@sell');
    Route::get('/item/delete', 'ItemController@delete');
    Route::get('/item/publish', 'ItemController@publish');
    //sold
    Route::any('/sold/itemlist', 'SoldController@itemlist');
});

Route::group(['namespace'=>'Cart', 'prefix'=>'cart'], function (){
    Route::any('/', 'IndexController@index');
});

Route::group(['namespace'=>'Pages', 'prefix'=>'pages'], function (){
    Route::get('/detail/{pageid}.html', 'DetailController@index');
});

//后台管理
Route::group(['namespace' => 'Admin','prefix'=>'admin'], function(){
    Route::get('login', 'LoginController@index');
    Route::get('logout', 'LoginController@logout');
    Route::post('checklogin', 'LoginController@checklogin');

    Route::group(['middleware'=>'admin.auth'], function (){
        Route::get('/', 'IndexController@index');
        Route::get('/index/wellcome', 'IndexController@wellcome');
        //系统设置
        Route::get('/settings/{type}', 'SettingsController@index');
        Route::post('/settings/save', 'SettingsController@save');
        //应用管理
        Route::any('/app', 'AppController@index');
        Route::any('/app/edit', 'AppController@edit');
        //用户管理
        Route::get('/user', 'UserController@index');
        Route::post('user/edit', 'UserController@edit');
        Route::any('/usergroup', 'UserGroupController@index');
        //菜单管理
        Route::any('/menu', 'MenuController@index');
        Route::any('/menu/itemlist', 'MenuController@itemlist');
        //广告管理
        Route::any('/ad', 'AdController@index');
        Route::any('/ad/edit', 'AdController@edit');
        //内容板块
        Route::any('/block', 'BlockController@index');
        Route::any('/block/edit', 'BlockController@edit');
        Route::any('/block/itemlist', 'BlockController@itemlist');
        Route::any('/block/edit_item', 'BlockController@edit_item');
        Route::any('/block/setimage', 'BlockController@setimage');

        //文章管理
        Route::get('/post/index', 'PostController@index');
        Route::get('/post/publish', 'PostController@publish');
        Route::post('/post/save', 'PostController@save');
        Route::post('/post/delete', 'PostController@delete');
        Route::post('/post/setimage', 'PostController@setimage');
        Route::post('/post/review', 'PostController@review');

        Route::any('/postcatlog', 'PostCatlogController@index');
        Route::any('/postcatlog/edit', 'PostCatlogController@edit');
        Route::any('/postcatlog/merge', 'PostCatlogController@merge');
        Route::any('/postcatlog/delete', 'PostCatlogController@delete');
        Route::post('/postcatlog/seticon', 'PostCatlogController@seticon');

        //微信管理
        Route::any('/weixin/menu', 'WeixinController@menu');
        Route::any('/weixin/apply_menu', 'WeixinController@apply_menu');
        Route::any('/weixin/remove_menu', 'WeixinController@remove_menu');
        Route::any('/weixin/edit_menu', 'WeixinController@edit_menu');
        Route::any('/weixin/material', 'WeixinController@material');
        Route::any('/weixin/add_material', 'WeixinController@add_material');
        Route::any('/weixin/news', 'WeixinController@news');
        Route::any('/weixin/add_news', 'WeixinController@add_news');
        Route::any('/weixin/viewimage', 'WeixinController@viewimage');

        //页面管理
        Route::any('/pages', 'PagesController@index');
        Route::any('/pages/edit', 'PagesController@edit');
        Route::any('/pages/category', 'PagesController@category');
        //素材管理
        Route::any('material', 'MaterialController@index');
        //区域管理
        Route::get('/district', 'DistrictController@index');
        Route::post('/district/save', 'DistrictController@save');
        //快递管理
        Route::get('/express', 'ExpressController@index');
        Route::post('/express/save', 'ExpressController@save');

        //友情链接
        Route::get('/link', 'LinkController@index');
        Route::post('/link/save', 'LinkController@save');
        Route::post('/link/setimage', 'LinkController@setimage');

        //企业管理
        Route::any('/company', 'CompanyController@index');
        Route::any('/company/add', 'CompanyController@add');
        //职位
        Route::any('/job', 'JobController@index');
        Route::any('/job/publish', 'JobController@publish');
        Route::any('/resume', 'ResumeController@index');
    });
});

Route::group(['namespace'=>'Mobile', 'prefix'=>'mobile'], function (){
    Route::get('/', 'IndexController@index');

    Route::get('/post/detail/{aid}.html', 'PostController@detail');
    Route::get('/post/list', 'PostController@itemlist');

    Route::get('/job/list', 'JobController@itemlist');
    Route::get('/job/detail/{id}.html', 'JobController@detail');

    Route::any('/join/index', 'JoinController@index');
    Route::any('/join/enroll', 'JoinController@enroll');

    Route::any('/login', 'SignController@signin');
    Route::any('/register', 'SignController@signup');

    Route::get('/member', 'MemberController@index');
    Route::get('/member/archive', 'MemberController@archive')->middleware('mobile.auth');

    Route::get('/pages/list', 'PagesController@index');
    Route::get('/pages/detail/{pageid}.html', 'PagesController@detail');

    Route::get('/company', 'CompanyController@index');
    Route::get('/company/detail/{id}.html', 'CompanyController@detail');

    Route::get('/daren', 'DarenController@index')->middleware(['mobile.auth']);
    Route::get('/space/{uid}', 'SpaceController@index')->middleware(['mobile.auth']);

    Route::get('/resume', 'ResumeController@index')->middleware(['mobile.auth']);
    Route::any('/resume/edit', 'ResumeController@edit')->middleware(['mobile.auth']);
    Route::get('/resume/delete', 'ResumeController@delete')->middleware(['mobile.auth']);
    Route::get('/resume/detail/{id}.html', 'ResumeController@detail')->middleware(['mobile.auth']);

    Route::get('/favorite', 'FavoriteController@index')->middleware(['mobile.auth']);
    Route::any('/feedback', 'FeedbackController@index')->middleware(['mobile.auth']);
});

Route::group(['namespace'=>'App', 'prefix'=>'app'], function (){
    Route::get('/post/detail/{aid}.html', 'PostController@detail');
});

Route::group(['namespace' => 'Member', 'middleware' => 'member.auth', 'prefix' => 'member'], function () {
    Route::get('/', 'IndexController@index');
    Route::any('/settings/userinfo', 'SettingsController@userinfo');
    Route::any('/settings/security', 'SettingsController@security');
    Route::any('/settings/verify', 'SettingsController@verify');
    Route::any('/settings/set_avatar', 'SettingsController@set_avatar');

    Route::any('/wallet', 'WalletController@index');
    Route::any('/address', 'AddressController@index');
    Route::any('/address/setdefault', 'AddressController@setdefault');
    Route::any('/address/delete', 'AddressController@delete');
    Route::any('/collection/delete', 'CollectionController@delete');
    Route::any('/collection/{type}', 'CollectionController@index');
    Route::any('/comment', 'CommentController@index');
});

Route::get('/avatar/{code}', 'Plugin\AvatarController@index');
Route::group(['namespace'=>'Plugin', 'prefix'=>'plugin'], function (){
    Route::get('/image', 'ImageController@index');
});

Route::group(['namespace' => 'Account', 'prefix'=>'account'], function (){
    Route::get('/login', 'LoginController@index');
    Route::post('/login/check', 'LoginController@check');
    Route::get('/logout', 'LogoutController@index');
    Route::get('/register', 'RegisterController@index');
    Route::post('register/save', 'RegisterController@save');
    Route::any('/register/check', 'RegisterController@check');
});


//service
Route::post('/service/upload/image', 'Service\UploadController@image');

Route::group(['namespace' => 'Post'], function (){
    Route::get('news', 'IndexController@index');

    Route::group(['prefix'=>'post'], function (){
        Route::get('/list', 'ListController@index');
        Route::get('/detail/{aid}.html', 'DetailController@index');
    });
});
