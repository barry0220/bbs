<?php

namespace App\Http\Controllers\Home;

use App\Models\Mycollect;
use App\Models\Plates;
use App\Models\Post;
use App\Models\Replay;
use App\Models\Scorelog;
use App\Models\UserDetail;
use App\Models\UserHome;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    //引入用户信息页面
    public function index()
    {
        // dd(session('testuser'));
        if (!session('homeuser')) {
            return redirect('/home/login');
        }
        //默认前台显示标签
        $type="details";
        //如果session中存在type 获取后销毁
        if (session('type')) {
            $type = session('type');
            Session::forget('type');
        }

        //引入个人信息页面
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();

        return view('home.user.userinfo',compact('details','plates','type'));
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

    //修改用户头像
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

    //发送邮件
    public function sendmail(Request $request)
    {
        $input = $request->except('_token');

        $rule = ['email'=>['regex:/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/']];
        $msg = ['email.regex'=>'邮箱格式错误,请重新输入'];
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


        $email = $input['email'];
        $user = session('homeuser');

        $res = Mail::send('home.activemail', ['user' => $user,'email'=>$email], function ($message) use ($user,$email) {
            $message->to($email, $user->username)->subject('谜之论坛帐号激活邮件!');
        });

        if($res) {
            $data=[
                'status'=>0,
                'msg'=>'发送邮件成功,请登录邮箱验证'
            ];
        } else {
            $data=[
                'status'=>1,
                'msg'=>'发送邮件失败,请重新发送'
            ];
        }

        return  $data;

    }
    //激活帐户
    public function activeuser(Request $request)
    {
        //接收传来的数据
        try{
            $input = $request->all();

            $user = UserHome::find($input['uid']);

            if ($input['usertoken'] == $user->user_token) {
                if ($user -> status == '2') {
                    $user -> status = 0;
                }
                $user -> email = $input['email'];

                $res = $user -> save();
                if ($res) {
                    session(['homeuser'=>$user,'type'=>'email']);
                    return redirect('/home/userinfo');
                } else {
                    $info = "帐户激活失败..请稍后重试";

                    return view('errors.error',compact('info'));
                }
            } else {
                $info = "无效的邮箱激活链接，请联系客服.";
                return view('errors.error',compact('info'));
            }
        } catch(\Exception $e){
            $info = $e->getMessage();
            return view('errors.error',compact('info'));
        }

    }


    //我的回复
    public function myreplay()
    {
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();

        $info = \DB::table('replay')
            ->leftjoin('post','replay.postid','=','post.id')
            ->leftJoin('user', 'user.id', '=', 'post.uid')
            ->leftJoin('plates', 'plates.id', '=', 'post.pid')
            ->select('replay.*','post.title','post.posttime','plates.pname','plates.id as platesid','user.username' )
            ->where('replay.uid',session('homeuser')->id)
            ->paginate(3);


        return view('home.user.myreplay',compact('details','plates','info'));
    }

    //回复我的
    public function replayme()
    {
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();
        //查询自己回复所有帖子的ID
        $replayids = \DB::table('replay')->where('uid',session('homeuser')->id)->lists('id');

        //查询父类pid是自己ID的帖子
        $info = \DB::table('replay')
            ->leftjoin('post','replay.postid','=','post.id')
            ->leftJoin('user', 'user.id', '=', 'post.uid')
            ->leftJoin('user_detail', 'user_detail.uid', '=', 'user.id')
            ->leftJoin('plates', 'plates.id', '=', 'post.pid')
            ->select('replay.*','post.title','plates.pname','plates.id as platesid','user.username','user_detail.profile as userface' )
            ->whereIn('replay.pid',$replayids)
            ->paginate(3);

        // dd($info);

        return view('home.user.replayme',compact('details','plates','info'));
    }

    //我的主贴
    public function mypost()
    {
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();

        $info = \DB::table('post')
            ->leftJoin('tags', 'tags.id', '=', 'post.tagid')
            ->leftJoin('plates', 'plates.id', '=', 'post.pid')
            ->where('post.uid',session('homeuser')->id)
            ->where('status',0)
            ->select('post.*','tags.tagname','tags.imgfile as tagfile','plates.pname','plates.imgfile as platesfile' )
            ->paginate();
        // dd($info);

        return view('home.user.mypost',compact('details','plates','info'));
    }

    //删除我的主贴到回收站
    public function delpost(Request $request)
    {
        $id = $request->only('id');
        $res = Post::where('id',$id)->update(['status'=>1]);
        if($res) {
            $data=[
                'status'=>0,
                'msg'=>'删除成功,请到回收站查看'
            ];
        } else {
            $data=[
                'status'=>1,
                // 'msg'=>'删除失败,请稍后重试'
                'msg'=>$id
            ];
        }

        return  $data;
    }

    //我的回收站
    public function myrecycle()
    {
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();

        $info = \DB::table('post')
            ->leftJoin('tags', 'tags.id', '=', 'post.tagid')
            ->leftJoin('plates', 'plates.id', '=', 'post.pid')
            ->where('post.uid',session('homeuser')->id)
            ->where('status',1)
            ->select('post.*','tags.tagname','tags.imgfile as tagfile','plates.pname','plates.imgfile as platesfile' )
            ->paginate(3);
        // dd($info);

        return view('home.user.myrecycle',compact('details','plates','info'));
    }

    //从回收站彻底删除帖子 如果帖子存在评论则不允许删除
    public function delrecycle(Request $request)
    {
        $id = $request->only('id');

        $replay = Replay::where('postid',$id)->first();

        if ($replay) {
            $data=[
                'status'=>1,
                'msg'=>'删除失败,该帖子存在评论不允许删除'
            ];

            return $data;
        }

        $res = Post::where('id',$id)->delete();
        if($res) {
            $data=[
                'status'=>0,
                'msg'=>'删除成功'
            ];
        } else {
            $data=[
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }

        return  $data;
    }

    //我的收藏
    public function mycollect()
    {
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();

        $info = \DB::table('mycollect')
            ->leftjoin('post','mycollect.postid','=','post.id')
            ->leftJoin('tags', 'tags.id', '=', 'post.tagid')
            ->leftJoin('plates', 'plates.id', '=', 'post.pid')
            ->where('mycollect.uid',session('homeuser')->id)
            ->where('status',0)
            ->select('mycollect.*','post.title','tags.tagname','plates.pname','plates.id as platesid' )
            ->paginate(3);
        // dd($info);

        return view('home.user.mycollect',compact('details','plates','info'));
    }

    //取消收藏
    public function discollect(Request $request)
    {
        $id = $request->only('id');

        $res = Mycollect::where('id',$id)->delete();
        if($res) {
            $data=[
                'status'=>0,
                'msg'=>'取消收藏成功'
            ];
        } else {
            $data=[
                'status'=>1,
                'msg'=>'取消收藏失败'
            ];
        }

        return  $data;
    }

    //我的积分记录
    public function myscorelog()
    {
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        $plates = Plates::get();

        $info = Scorelog::where('uid',session('homeuser')->id)->paginate(3);

        return view('home.user.myscorelog',compact('details','plates','info'));
    }
}
