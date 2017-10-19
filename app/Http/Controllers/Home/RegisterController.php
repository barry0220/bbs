<?php

namespace App\Http\Controllers\Home;

use App\Models\Scorelog;
use App\Models\UserDetail;
use App\Models\UserHome;
use Illuminate\Http\Request;
use App\SMS\M3Result;
use App\SMS\SendTemplateSMS;

use App\Http\Controllers\Controller;
require_once app_path().'/Http/Org/code/Code.class.php';
use App\Http\Org\code\Code;


use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    //引入注册页面
    public function showregister()
    {
        // dd(session('homecode'));
        return view('home.register');
    }

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
        // \Session::flash('homeregcode', $phrase);
        session(['homeregcode'=>$phrase]);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
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

    //手机号注册实现业务逻辑
    public function doregister(Request $request)
    {

       // 获取用户提交的数据，保存到数据表user，完成注册
        $input = $request->except('_token');
        // dd(strtoupper(session('homecode')).'-----------'.strtoupper($input['code']));
        // 进行表单验证
        $rule=[
            'username'=>'required|between:3,16',
            'password'=>'required|between:3,16',
            'repassword'=>'required|same:password',
            'code'=>'required',
            'phone'=>'required|regex:/^1[34578]\d{9}$/',
            'phonecode'=>'required'
        ];
        $msg = [
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名必须在3-16位之间',
            'password.between'=>'密码必须在3-16位之间',
            'password.required'=>'密码必须输入',
            'code.required'=>'验证码必须输入',
            'phone.required'=>'手机号必须输入',
            'phonecode.required'=>'手机验证码必须输入',
            'phone.regex'=>'手机号格式不正确',
            'repassword.required'=>'重新输入密码框不能为空',
            'repassword.same'=>'两次输入密码不一致'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            return redirect('home/register')
                ->withErrors($validator)
                ->withInput();
        }
        //3.0 验证码是否正确

        if(strtoupper($input['code'])  != strtoupper(session('homeregcode'))){
            // dd(session('homeregcode'));
            return redirect('home/register')->with('errors','验证码输入错误')->withInput();
        }
        // 手机验证码是否正确
        if($input['phonecode'] != session('phone')){
            return redirect('home/register')->with('errors','手机验证码错误')->withInput();
        }

        // dd(strtoupper(session('homeregcode')).'---'.strtoupper($input['code']));
        //验证用户是否已经存在
        $user = UserHome::where('phone',$input['phone'])
                        ->orWhere('username',$input['username'])
                        ->first();
        if ($user['phone'] == $input['phone']){
            return redirect('home/register')->with('errors','该手机号已经被注册')->withInput();
        }
        if ($user['username'] == $input['username']){
            return redirect('home/register')->with('errors','该用户名已经被注册')->withInput();
        }


        $homeuser = new UserHome();
        $homeuser->phone = $input['phone'];
        $homeuser->username = $input['username'];
        $homeuser->password = Hash::make($input['password']);
       // 令牌，激活邮箱时使用，为了保证邮箱时有效邮箱
        $homeuser->user_token = Hash::make($input['password']);
        $homeuser->status = 2;       //新注册用户未验证邮箱没有发帖回帖等权限
        //创建一个新用户
        $res = $homeuser->save();
        $uid = $homeuser->id;
        //如果注册成功
        if($res){
            //增加用户详情表信息 注册时间  赠送积分等
            $detail = new UserDetail();
            $detail -> uid = $uid;
            $detail -> regtime = time();
            $detail -> logintime = time();
            $detail -> score = 50;
            $detail -> detail = "请输入个人简介";
            try{
                $detail -> save();
            }catch (\Exception $e){
                // $e.message('服务器内部错误,请重新注册');
                UserHome::destroy($uid);
                return back()->with('errors','注册失败，请重新注册');
            }
            //记录增加积分的日志
            $scoreinfo=[
                'uid'=>$uid,
                'time'=>time(),
                'handle'=>'新注册用户赠送50积分',
                'scorelog'=>'+50'
            ];

            try{
                Scorelog::create($scoreinfo);
            }catch (\Exception $e){
                // $e.message('服务器内部错误,请重新注册');
                UserDetail::where('uid',$uid)->delete();
                UserHome::where('id',$uid)->delete();
                return back()->with('errors','注册失败，请重新注册');
            }

            // if (!$re) {
            //     dd($detail);
            // }
            session(['homeuser'=>$homeuser]);
            session(['type'=>'email']);
            return redirect('home/userinfo');
        }else{
            return back()->with('errors','注册失败，请重新注册');
        }


    }
}
