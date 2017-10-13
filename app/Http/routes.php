<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//后台主页面
Route::get('/', function () {
//    return view('Admin.index');
    return redirect('/home/login');
});

//后台登录页
Route::get('admin/login','Admin\LoginController@login');
//后台登录处理页
Route::post('admin/dologin','Admin\LoginController@dologin');

Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');
Route::group(['middleware'=>'login','prefix'=>'admin','namespace'=>'Admin'],function(){

    //验证码路由
//    Route::get('admin/yzm','LoginController@yzm');
    //用户模块路由
    Route::resource('/user/index','UserController');
//    Route::get('admin/user','Admin\UserController@index');
    //用户添加模块
    Route::resource('/user','UserController');

    //板块设置管理
    Route::resource('/plates','PlatesController');
    //单独定义路由用于板块修改提交
    Route::post('/plates/update/{id}','PlatesController@update');
    //图像上传OSS控制器方法
    Route::post('/upload/{type}','UploadController@upload');

    //板块设置添加子类路由
    Route::get('/childadd/{id}','PlatesController@childadd');
    Route::get('/childedit/{id}','PlatesController@childedit');
    Route::post('/childdoedit/{id}','PlatesController@childdoedit');
    Route::post('/childdel/{id}','PlatesController@childdel');

    //友情链接设置模块
    Route::resource('/links','LinksController');
    //帖子管理管理模块
    Route::resource('/post','PostController');
    Route::post('/post/disables/{id}','PostController@disables');
    Route::post('/post/open/{id}','PostController@open');

    // 敏感词管理
    Route::resource('/warwork','WarworkController');

    //帖子标签设置模块
    Route::resource('/tags','TagsController');
    //单独定义路由用于标签修改提交
    Route::post('/tags/update/{id}','TagsController@update');

    //网站配置模块
    Route::get('/webconfigs','WebConfigsController@index');
    //网站配置模块修改提交
    Route::post('/webconfigs/update/{id}','WebConfigsController@update');

    //广告管理设置模块
    Route::resource('/adspace','AdspaceController');
    //单独定义路由用于广告管理修改提交
    Route::post('/adspace/update/{id}','AdspaceController@update');

    //轮播图管理设置模块
    Route::resource('/runimg','RunImgController');
    //单独定义路由用于轮播图管理修改提交
    Route::post('/runimg/update/{id}','RunImgController@update');

});

//前台页面路由规则

Route::group(['prefix'=>'home','namespace'=>'Home'],function(){

    // 登录路由
    Route::resource('/login','LoginController');
    //用户路由
    Route::resource('/user','UserController');
    // 忘记密码路由
    Route::get('/forget','CommonController@forget');
    // 网络服务协议和声明
    Route::get('/agreement','CommonController@agreement');






});


