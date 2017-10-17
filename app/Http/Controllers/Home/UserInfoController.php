<?php

namespace App\Http\Controllers\Home;

use App\Models\Plates;
use App\Models\UserDetail;
use App\Models\UserHome;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{

    public function index()
    {
        // dd(session('testuser'));
        if (!session('homeuser')) {
            return redirect('/home/login');
        }
        //引入个人信息页面
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();
        return view('home.user.userinfo',compact('details','plates'));
    }

    //修改用户详细信息
    public function updateuserinfo(Request $request)
    {
        //接收要修改的记录的内容和id
        $input = $request -> except('_token')['arr'];

        //如果存在身份证号验证身份证号格式
        if ($input['idnum']) {
            $rule = [
                'idnum'=>['regex:/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/']
            ];
            $msg = [
                'idnum.regex'=>'身份证格式不正确'
            ];

            //进行手工表单验证
            $validator = Validator::make($input,$rule,$msg);
            //如果验证失败
            if($validator->fails()){
                $message = $validator->errors()->first();
                $data=[
                    'status'=>1,
                    'msg'=>'修改失败,'.$message
                ];
                return $data;
            }
        }



        $res = UserDetail::where('uid',session('homeuser')->id)->update($input);


        //4.判断执行是否成功
        // dd($res);
        if ($res) {
            $data=[
                'status'=>0,
                'msg'=>'用户信息修改成功'
            ];
        }else {
            $data=[
                'status'=>1,
                'msg'=>'用户信息修改失败'
            ];
        }
        return $data;
    }

    //修改用户密码
    public function repassword(Request $request)
    {
        //1.获取用户传过来的新密码
        $input = $request->except('_token');

        //2.对提交过来的数据进行表单验证
        $rule=[
            'password_o'=>'required|between:3,16',
            'password_n'=>'required|between:3,16',
            'repassword_n'=>'required|same:password_n'
        ];
        $msg = [
            'password_o.required'=>'原始密码必须输入',
            'password_o.between'=>'原始密码必须在3-16位之间',
            'password_n.required'=>'新密码必须输入',
            'password_n.between'=>'新密码必须在3-16位之间',
            'repassword_n.required'=>'确认密码必须输入',
            'repassword_n.same'=>'两次输入新密码不一致'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            $message = $validator->errors()->first();
            $data=[
                'status'=>1,
                'msg'=>'修改失败,'.$message
            ];
            return $data;
        }
        //执行修改密码操作
        //判断原密码是否正确
        $user = UserHome::find(session('homeuser')->id);

        if(!Hash::check($input['password_o'],$user->password) ){
            $data=[
                'status'=>1,
                'msg'=>'原始密码输入错误'
            ];
            return $data;
        }
        //修改密码
        $user->password = Hash::make($input['password_n']);
        $re = $user->save();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'密码修改成功'
            ];
            //获取新的用户信息
            $newuser = UserHome::find(session('homeuser')->id);
            //清空旧的session
            Session::forget('homeuser');
            //存入新的session
            session(['homeuser'=>$newuser]);
        }else{
            $data=[
                'status'=>1,
                'msg'=>'密码修改失败'
            ];
        }
        return $data;
    }

    public function updateface(Request $request)
    {
        $input = $request -> except('_token');


        $user = UserDetail::where('uid',session('homeuser')->id)->first();
        // session(['testuser'=>$user]);

        $user->profile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['profile'];

        $res = $user ->save();

        if ($res) {
            $data=[
                'status'=>0,
                'msg'=>'用户头像修改成功'
            ];
        }else {
            $data=[
                'status'=>1,
                'msg'=>'用户头像修改失败'
            ];
        }
        return $data;
    }
}
