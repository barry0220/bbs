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
    redirect('/admin/plates');
});


//板块设置管理
Route::resource('/admin/plates','Admin\PlatesController');
Route::post('/admin/upload','Admin\PlatesController@upload');
