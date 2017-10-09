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
    return redirect('/admin/plates');
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
    Route::post('/upload','PlatesController@upload');

    //板块设置添加子类路由
    Route::get('/childadd/{id}','PlatesController@childadd');
    Route::get('/childedit/{id}','PlatesController@childedit');
    Route::post('/childdoedit/{id}','PlatesController@childdoedit');
    Route::post('/childdel/{id}','PlatesController@childdel');

    //友情链接设置模块
    Route::resource('/links','LinksController');
    //帖子管理管理模块
    Route::resource('/post','PostController');
});


