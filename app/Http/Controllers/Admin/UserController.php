<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $user = DB::table('admins')->paginate(2);

        $sex = ['女','男'];
        return view('admin/user/index',['user'=>$user,'sex'=>$sex]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加用户
        return view('admin/user/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        //1.接受前台用户传过来的数据
        $input = $request->except('_token');

        //2.对提交过来的数据进行表单验证，用户名必须输入而且在4-18位之间，密码必须输入而且在4-18位之间
//        Validator::make('要进行表单验证的数据','验证规则','设置提示信息')
        $rule=[
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18',
            'repassword'=>'required|same:password',
            'age'=>'regex:/\d+/',
            'phone'=>'regex:/1[3578]\d{9}/',
            'email'=>'regex:/^\w+@\w+(\.com|\.cn|\.cc|\.net|\.co|\.top){1,2}$/'

        ];
        $msg = [
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名必须在4-18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在4-18位之间',
            'repassword.required'=>'确认密码必须输入',
            'repassword.same'=>'两次密码输入不一致',
            'age.regex'=>'年龄格式不正确',
            'phone.regex'=>'手机号码格式不正确',
            'email.regex'=>'邮箱地址格式不正确'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()) {
            return redirect('admin/user/create')
                ->withErrors($validator)
                ->withInput();

        }
        //3.执行数据库添加操作（向admins表添加一条记录）
        $user = new User();
        $user->username = $input['username'];
        $user->password = Hash::make($input['password']);
        $user->nickname = $input['nickname'];
        $user->sex = $input['sex'];
        $user->age = $input['age'];
        $user->phone = $input['phone'];
        $user->email = $input['email'];

        $re = $user->save();

        //4.判断执行是否成功
        if ($re) {
            return redirect('admin/user');
        }else {
            return redirect('admin/user/create')->with('msg','用户添加失败');
        }

        //5.如果成功，跳转到列表页；如果失败，跳转到添加页继续添加
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return '这是修改方法';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
