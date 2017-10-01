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
<<<<<<< HEAD


//板块设置管理
Route::resource('/admin/plates','Admin\PlatesController');
Route::post('/admin/upload','Admin\PlatesController@upload');

//添加子类路由
Route::get('/admin/childadd/{id}','Admin\PlatesController@childadd');
Route::get('/admin/childedit/{id}','Admin\PlatesController@childedit');
Route::post('/admin/childdoedit/{id}','Admin\PlatesController@childdoedit');
Route::post('/admin/childdel/{id}','Admin\PlatesController@childdel');
=======
//后台登录页
Route::get('admin/login','Admin\LoginController@login');
//后台登录处理页
Route::post('admin/dologin','Admin\LoginController@dologin');

Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');
Route::group(['middleware'=>'login','namespace'=>'Admin'],function(){

    //验证码路由
//    Route::get('admin/yzm','LoginController@yzm');
    //用户模块路由
    Route::resource('/admin/user/index','UserController');
//    Route::get('admin/user','Admin\UserController@index');
    //用户添加模块
    Route::resource('admin/user','UserController');
});


>>>>>>> wss
