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
Route::get('/admin/index', function () {
//    return view('Admin.index');
    return redirect('/home/login');
});

Route::resource('/home/index','Home\PostController');
Route::get('/home/hottoday','Home\PostController@hottoday');



//后台登录页
Route::get('admin/login','Admin\LoginController@login');
//后台登录处理页
Route::post('admin/dologin','Admin\LoginController@dologin');

Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');
//前台登录验证码
Route::get('/homecode/captcha/{tmp}', 'Home\LoginController@captcha');
//前台注册验证码
Route::get('/homeregcode/captcha/{tmp}', 'Home\RegisterController@captcha');
//前台手机验证码
Route::post('/sendcode','Home\RegisterController@sendCode');

//Route::get('admin/user/repass','Admin\UserController@repass');
Route::group(['middleware'=>'login','prefix'=>'admin','namespace'=>'Admin'],function(){

    //验证码路由
//    Route::get('admin/yzm','LoginController@yzm');


    //后台用户模块
    Route::resource('/user','UserController');
    //检查用户名 邮箱是否存在
    Route::post('/checkuser','UserController@checkuser');

    //前台用户模块
    Route::resource('/userhome','UserHomeController');

    Route::post('/disables/{id}','UserHomeController@disables');
    Route::post('/open/{id}','UserHomeController@open');


    //管理员修改密码
    Route::get('/repass','UserController@repass');
    Route::post('/dorepass/{id}','UserController@dorepass');
    //管理员退出登录
    Route::post('/loginout','LoginController@loginOut');

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
    //活动贴管理
    Route::resource('/active','ActiveController');

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

    // 登录页面路由
    Route::get('/login','LoginController@showlogin');
    // 登录执行路由
    Route::post('/dologin','LoginController@dologin');
    // 注册页面路由
    Route::get('/register','RegisterController@showregister');
    // 注册执行路由
    Route::post('/doregister','RegisterController@doregister');

    // 忘记密码路由
    Route::get('/forget','CommonController@forget');
    // 网络服务协议和声明
    Route::get('/agreement','CommonController@agreement');
    //用户个人信息管理
    Route::get('/userinfo','UserInfoController@index');
    //用户个人详细信息修改
    Route::post('/updateuserinfo','UserInfoController@updateuserinfo');
    //用户个人密码修改
    Route::post('/repass','UserInfoController@repassword');
    //用户头像修改
    Route::post('/updateface','UserInfoController@updateface');
    //用户退出登录
    Route::post('/loginout','LoginController@loginOut');


});


//前台首页
Route::resource('/','Home\IndexController@index');