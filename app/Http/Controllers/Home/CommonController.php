<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //忘记密码
    public function forget()
    {
        return 11111;
        return view('home.user.resetpassword');
    }


    //协议和声明
    public function agreement()
    {
        return 22222222222;
    }
}
