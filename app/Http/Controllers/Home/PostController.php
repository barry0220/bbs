<?php

namespace App\Http\Controllers\Home;

use App\Models\Admireortread;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Models\Plates;
use App\Models\Tags;
use App\Models\Mycollect;
use App\Models\Post;
use App\Models\Replay;
use App\Models\UserHome;
use App\Http\Controllers\Controller;
use App\Models\ChildPlates;
use App\User;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\UserDetail;
use App\Models\Scorelog;




class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 板块 原创帖文显示
    public function index()
    {
        // dd(config('webconfig'));
        // dd(config('linksconfig'));
        
        $plates = Plates::get();
        $author = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->leftjoin('user_detail','user_detail.uid','=','post.id')
            ->select('post.*','user.username','user_detail.profile')
            ->groupBy('post.uid')
            ->limit(10)
            ->get();
        //标签
        $tags = Tags::get();
        // 帖子信息 分页
        $post = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->select('post.*','user.username')
            ->where('tagid','2')->orderBy('id','desc')->paginate(8);
        //用户信息
        $users = UserHome::get();

        //把plates里的id 作为键
        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }


        // 显示视图 传参到视图页面
        return view('Home.post.index',compact('plates','tags','post','postplates','author'));
    }
    // 猫眼观察显示列表
    public function cateye()
    {
        # code...
        // 获取所有版块
        $plates = Plates::get();
        //优秀作者排序
        $author = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->leftjoin('user_detail','user_detail.uid','=','post.id')
            ->select('post.*','user.username','user_detail.profile')
            ->groupBy('post.uid')
            ->limit(10)
            ->get();
        //所有标签信息
        $tags = Tags::get();
        //所有帖子信息   分页
        $post = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->select('post.*','user.username')
            ->where('tagid','4')->orderBy('id','desc')->paginate(8);

        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }

        // 显示视图 传参
        return view('Home.post.index',compact('plates','tags','post','postplates','author'));



    }

    //标签显示列表
    public function lists(Request $request,$id)
    {
        
        $plates = Plates::get();
        //根据标签id显示帖子列表 根据id倒序 
        $posts = Post::where('tagid',$id)->orderBy('id','desc')->paginate(8);

        $tags = Tags::get();
        //获取点击量最高的作者 10人
        // $aaauthor = Post::orderBy('clickcount','desc')->groupBy('uid')->limit(10)->get();
        $author = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->leftjoin('user_detail','user_detail.uid','=','post.id')
            ->select('post.*','user.username','user_detail.profile')
            ->groupBy('post.uid')
            ->limit(10)
            ->get();



        $statu=['普通帖','活动贴','公告贴'];
        //显示视图
        return view('/home/post/list',compact('plates','posts','statu','tags','id','author'));

    }
    //板块显示列表
    public function plateslist(Request $request,$id)
    {
        
        $plates = Plates::get();
        // $posts = Post::where('pid',$id)->orderBy('id','desc')->paginate(10);

        $posts = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->select('post.*','user.username')
            ->where('pid',$id)->orderBy('id','desc')->paginate(10);

        $tags = Tags::get();
        $author = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->leftjoin('user_detail','user_detail.uid','=','post.id')
            ->select('post.*','user.username','user_detail.profile')
            ->groupBy('post.uid')
            ->limit(10)
            ->get();

        $statu=['普通帖','活动贴','公告贴'];

        return view('/home/post/plateslist',compact('plates','posts','statu','tags','author'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 显示发表帖子页面
    public function create()
    {
        if (session('homeuser')) {
            $status = session('homeuser')->status;
            if ($status == 2) {
                $info = "您的帐号还没有激活,请先验证邮箱";
                return view('errors.error',compact('info'));
            }
            $pls = Plates::get();
            $childPlates = new ChildPlates();
            $cls = $childPlates ->get();
            $id = 0;

            $tag = Tags::get();



            return view('home/post/add',compact('pls','cls','id','tag'));
        } else {
            $info = "请先登录在进行此操作";

            return view('errors.error',compact('info'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 执行发表帖子
    public function store(Request $request)
    {
        //

          $input = $request->except('_token');

         $rule=[

            'title'=>'required',
            'keywords'=>'required',
            'content'=>'required',
            // 'pid'=>'regex://'
            // 'cid'=>
        ];
        $msg = [
            'title.required'=>'标题不能为空',
            'keywords.required'=>'关键词不能为空',
            'content.required'=>'内容不能为空'
            // 'pid.required'=>'内容不能为空'
            // 'content.required'=>'内容不能为空'
        ];

     //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()) {
            return redirect('admin/active/create')
                ->withErrors($validator)
                ->withInput();

        }


        $post = new Post();
        $post->title = $input['title'];
        $post->pid = $input['pid'];
        $post->tagid = $input['tid'];
        $post->posttime = time();
        $post->keywords = $input['keywords'];
        $post->cid = $input['cid'];
        $post->postcode = '0';
        $post->content = $input['content'];
        $post->uid = session('homeuser')->id;
        $res = $post -> save();

        //记录增加积分的日志
        $scoreinfo=[
            'uid'=>session('homeuser')->id,
            'time'=>time(),
            'handle'=>'发表帖子增加10积分',
            'scorelog'=>'+10'
        ];
        $details = UserDetail::where('uid',session('homeuser')->id)->first();
        try{
            $details -> score = $details['score']+10;
            $details -> save();
            Scorelog::create($scoreinfo);
        }catch (\Exception $e){
            // $e.message('服务器内部错误,请重新注册');
            return back()->with('errors','意外错误，请重新发帖');
        }


        if ($res) {

            return redirect('home/post');
        } else {
            // return back()->with('errors','发表活动贴失败');
            return redirect('home/post/create')->with('msg','发表失败');

        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 显示帖子详情数据页面
    public function show($id)
    {
        //帖子详情页
//    dd(session('testid'));
        $postinfo = \DB::table('post')
            ->leftjoin('user','user.id','=','post.uid')
            ->leftjoin('plates','plates.id','=','post.pid')
            ->select('post.*','user.username','plates.pname')
            ->where('post.id',$id)
            ->first();
        // dd($postinfo->username);


        $replay = \DB::table('replay')
            ->leftjoin('user','user.id','=','replay.uid')
            ->select('replay.*','user.username')
            ->where('postid',$id)->paginate(3);



        // dd($replay);
        //点击量加一
        $click = Post::where('id',$id)->first();
        $click -> clickcount = $click['clickcount']+1;
        $click->save();

        //判断当前用户对帖子是赞还是踩
        //默认为0 未点击状态  判断是否登录
        $admireortread = 0;
        if (session('homeuser')) {
            $admireortread = Admireortread::where('postid',$id)->where('uid',session('homeuser')->id)->first()['status'];
        }
//        dd($admireortread);

        return view('/home/post/detail',compact('postinfo','replay','plates','admireortread'));

    }

    // 评论帖子
    public function replay(Request $request)
    {
 
     
        $input = $request->except('_token');


        $replay = new Replay();        
        $replay->uid = session('homeuser')->id;
        $replay->postid = $input['id'];
        $replay->content = $input['content'];
        $replay->pid = 0;
        // $replay->floor = 
        $replay->time = time();
        
        $re = $replay->save();

        if($re){
          $data=[
              'status'=>0,
              'msg'=>'回复成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'回复失败'
            ];
        }
          return  $data;

    }

    // 回复评论
    public function rep(Request $request)
    {
 
     
        $input = $request->except('_token');


        $replay = new Replay();        
        $replay->uid = session('homeuser')->id;
        $replay->postid = $input['postid'];
        $replay->content = $input['content'];
        $replay->pid = $input['author'];
        $replay->time = time();
        
        $re = $replay->save();

        if($re){
          $data=[
              'status'=>0,
              'msg'=>'回复成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'回复失败'
            ];
        }
          return  $data;

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
    //收藏帖子
    public function collection(Request $request){

               // $re = Post::where('id',$id)->update(['status'=>'0']); 

 
              
        $input = $request->except('_token');

        $info = Mycollect::get();
        foreach ($info as $k => $v) {
            # code...

            if($v->uid == session('homeuser')->id && $v->postid == $input['postid']){
                $data=[
                  'status'=>2,
                  'msg'=>'已收藏'
                 ];

                 return $data;
                }
        }
        $mycollect = new Mycollect();        
        $mycollect->uid = session('homeuser')->id;
        $mycollect->postid = $input['postid'];
        $mycollect->collecttime = time();
 
        $re = $mycollect->save();

         if($re){
          $data=[
              'status'=>0,
              'msg'=>'收藏成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'收藏失败'
            ];
        }
          return  $data;

    }
     //帖子点赞
    public function doadmire(Request $request){

        //获取上传的数据
        $input = $request->except('_token');
        $postid = $input['postid'];
        $uid = session('homeuser')->id;

        //增加到点赞表并且修改帖子的点赞数量
        $res = Admireortread::create(['postid'=>$postid,'uid'=>$uid,'status'=>1]);

         if($res){
             $post = Post::find($postid);
             $post->admire = intval($post->admire) +1;
             $post -> save();
          $data=[
              'status'=>0,
              'msg'=>'点赞成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'点赞失败'
            ];
        }
          return  $data;

    }

     //帖子点踩
    public function dotread(Request $request){
        //获取上传的数据
        $input = $request->except('_token');
        $postid = $input['postid'];
        $uid = session('homeuser')->id;

        //增加到点赞表并且修改帖子的点踩数量
        $res = Admireortread::create(['postid'=>$postid,'uid'=>$uid,'status'=>2]);

        if($res){
            $post = Post::find($postid);
            $post->tread = intval($post->tread)+1;
            $post -> save();
            $data=[
                'status'=>0,
                'msg'=>'点踩成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'点踩失败'
            ];
        }
        return  $data;

    }

    //帖子取消点赞
    public function downadmire(Request $request){
        //获取上传的数据
        $input = $request->except('_token');
        $postid = $input['postid'];
        $uid = session('homeuser')->id;

        //从点赞表删除并且修改帖子的点赞数量
        $admire = Admireortread::where('postid',$postid)->where('uid',$uid)->first();
        $res = $admire -> delete();

        if($res){
            $post = Post::find($postid);
            $post->admire = intval($post->admire)-1;
            $post -> save();
            $data=[
                'status'=>0,
                'msg'=>'取消点赞成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'取消点赞失败'
            ];
        }
        return  $data;

    }

    //帖子取消点踩
    public function downtread(Request $request){
        //获取上传的数据
        $input = $request->except('_token');
        $postid = $input['postid'];
        $uid = session('homeuser')->id;

        //从点赞表删除并且修改帖子的点踩数量
        $admire = Admireortread::where('postid',$postid)->where('uid',$uid)->first();
        $res = $admire -> delete();

        if($res){
            $post = Post::find($postid);
            $post->tread = intval($post->tread)-1;
            $post -> save();
            $data=[
                'status'=>0,
                'msg'=>'取消点踩成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'取消点踩失败'
            ];
        }
        return  $data;

    }
}
