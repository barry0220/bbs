<?php

namespace App\Http\Controllers\Home;

use App\Models\UserHome;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SMS\M3Result;
use App\SMS\SendTemplateSMS;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller
{
    //忘记密码
    public function forget()
    {
        return view('home.user.resetpass');
    }


    //协议和声明
    public function forgetrepass(Request $request)
    {
        //1.获取用户传过来的新密码
        $input = $request->except('_token');
        // dd($input);

        //2.对提交过来的数据进行表单验证
        $rule=[
            'password'=>'required|between:3,16',
            'repassword'=>'required|same:password'
        ];
        $msg = [
            'password.required'=>'新密码必须输入',
            'password.between'=>'新密码必须在3-16位之间',
            'repassword.required'=>'确认密码必须输入',
            'repassword.same'=>'两次输入新密码不一致'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        //执行修改密码操作
        //判断原密码是否正确
        $user = UserHome::where('phone',$input['phonenum'])->first();
        //修改密码
        $user->password = Hash::make($input['password']);
        $res = $user->save();
        if($res){
            return redirect('/home/login');
        }else{
            return back()->with('errors','密码修改失败');
        }
    }

    //  检测手机验证码是否正确
    public function resetcheck(Request $request)
    {
        // 获取用户提交的数据，保存到数据表user，完成注册
        $input = $request->except('_token');
        // 进行表单验证
        $rule=[
            'phone'=>'required|regex:/^1[34578]\d{9}$/',
            'phonecode'=>'required'
        ];
        $msg = [
            'phone.required'=>'手机号必须输入',
            'phonecode.required'=>'手机验证码必须输入',
            'phone.regex'=>'手机号格式不正确'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            $message = $validator->errors()->first();
            $data=[
                'status'=>1,
                'msg'=>'验证失败,'.$message
            ];
            return $data;
        }

        // 手机验证码是否正确
        if($input['phonecode'] != session('phone')){
            $data=[
                'status'=>1,
                'msg'=>'手机验证码不正确'
            ];
            return $data;
        }

        //验证用户是否存在
        $user = UserHome::where('phone',$input['phone'])->first();
        if ($user) {
            $data=[
                'status'=>0,
                'msg'=>'验证成功,请重新设置您的密码'
            ];
        }else {
            $data=[
                'status'=>1,
                'msg'=>'该用户不存在'
            ];
        }
        return $data;
    }

    //发送手机验证码
    public function sendCode(Request $request)
    {
        //1 获取到客户端传过来的所有的参数手机号、密码、验证码
        $input = $request->all();

        // 2 向手机号发送验证码
        $sendSMS = new SendTemplateSMS();

        $r = mt_rand(1000,9999);
        session(['phone'=>$r]);
        //转换为json格式的类
        $M3Result = new M3Result();
        // 核心  ： 发送验证码的方法
        $M3Result = $sendSMS->sendTemplateSMS($input['phone'],array($r,5),1);
        //将云平台的处理结果转换为json格式
        return $M3Result->toJson();

    }

    public function checkphone(Request $request)
    {
        //接收上传的数据
        $input = $request->except('_token');

        $user = UserHome::where('phone',$input['phone'])->first();

        if (!$user) {
            $data=[
                'status'=>0,
                'msg'=>"检查通过"
            ];
        }else {
            $data=[
                'status'=>1,
                'msg'=>'该手机号已经存在'
            ];
        }
        return $data;
    }

    public function checkusername(Request $request)
    {
        //接收上传的数据
        $input = $request->except('_token');

        $user = UserHome::where('username',$input['username'])->first();

        if (!$user) {
            $data=[
                'status'=>0,
                'msg'=>"检查通过"
            ];
        }else {
            $data=[
                'status'=>1,
                'msg'=>'该用户名已经存在'
            ];
        }
        return $data;
    }
}
