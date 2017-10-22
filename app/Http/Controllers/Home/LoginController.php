<?php

namespace App\Http\Controllers\Home;

use App\Models\Scorelog;
use App\Models\UserDetail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

require_once app_path().'/Http/Org/code/Code.class.php';
use App\Http\Org\code\Code;


use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class LoginController extends Controller
{

    // 验证码生成
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('homecode', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    public function showlogin()
    {
        //引入登录页面
        //如果已登录直接跳转到个人信息页面
        if (session('homeuser')) {
            return redirect('/home/userinfo');
        }
        return view('home.login');
    }


    public function dologin(Request $request){
        //1.接手前台用户提交过来的数据
        $input = $request->except('_token');
        //2.对提交过来的数据进行表单验证，用户名必须输入3~16个字符，字母/中文/数字/下划线
        $rule=[
            'EmailPhoneNcke'=>'required|between:3,16',
            'password'=>'required',
            'code'=>'required'
        ];
        $msg = [
            'EmailPhoneNcke.required'=>'用户名必须输入',
            'EmailPhoneNcke.between'=>'用户名必须在3-16位之间',
            'password.required'=>'密码必须输入',
            'code.required'=>'验证码必须输入'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            return redirect('home/login')
                ->withErrors($validator)
                ->withInput();

        }
        //验证码是否正确
        // dd(session('homecode'));
        if($input['code'] != session('homecode')){
            return redirect('home/login')->with('errors','验证码错误,请重新输入')->withInput();
        }
        //进行逻辑验证
        $user = DB::table('user')
            ->where('username',$input['EmailPhoneNcke'])
            ->orwhere('email',$input['EmailPhoneNcke'])
            ->orwhere('phone',$input['EmailPhoneNcke'])
            ->first();

        if (!$user){
            return redirect('home/login')->with('errors','用户不存在,请重新输入')->withInput();
        }
        //密码是否正确
        if( !Hash::check($input['password'],$user->password)){
            return redirect('home/login')->with('errors','密码不正确,请重新输入')->withInput();
        }

        //用户是否已经禁用
        if ($user->status == '1') {
            return redirect('home/login')->with('errors','帐户因违规已禁用,请联系管理员')->withInput();
        }

        //获取用户头像并存在session中
        $userface = UserDetail::where('uid',$user->id)->select('profile')->first();

        $user->userface = $userface['profile'];

        //将登录用户的状态值保存到session中

        session(['homeuser'=>$user]);

        //判断是否为当天第一次登录,第一次加10分积分否则不加
        $details = UserDetail::where('uid',$user->id)->first();

        $oldtime = date('d',$details -> logintime);
        $nowtime = date('d',time());

        if ($oldtime != $nowtime) {
            $details -> logintime = time();
            $details -> score = $details['score']+10;
            $details -> save();
        }

        //记录增加积分的日志
        $scoreinfo=[
            'uid'=>$user->id,
            'time'=>time(),
            'handle'=>'用户每天第一次登录10积分',
            'scorelog'=>'+10'
        ];

        Scorelog::create($scoreinfo);

        // session(['test'=>$r]);

        //进入前台首页
        return redirect('/');
    }
    //退出登录方法
    public function loginOut()
    {
        Session::forget('homeuser');

        if(Session::has('homeuser')){
            $data=[
                'status'=>1,
                'msg'=>'退出登录失败'
            ];
        }else{
            $data=[
                'status'=>0,
                'msg'=>'退出登录成功'
            ];
        }

        return  $data;
    }



}
