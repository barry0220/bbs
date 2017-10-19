<?php

namespace App\Http\Controllers\Home;

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
        
        $plates = Plates::get();
        $author = Post::orderBy('clickcount','desc')->groupBy('uid')->limit(10)->get();
        //标签
        $tags = Tags::get();
        // 帖子信息 分页
        $post = Post::where('tagid','2')->orderBy('id','desc')->paginate(8);
        //用户信息
        $users = UserHome::get();

        //把user里的id 作为键
        $postusers = [];

        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
        }
        //把plates里的id 作为键
        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }


        // 显示视图 传参到视图页面
        return view('Home.post.index',compact('plates','tags','post','postusers','postplates','author'));
    }
    // 猫眼观察显示列表
    public function cateye()
    {
        # code...
        // 获取所有版块
        $plates = Plates::get();
        //优秀作者排序
        $author = Post::orderBy('clickcount','desc')->limit(10)->get();
        //所有标签信息
        $tags = Tags::get();
        //所有帖子信息   分页
        $post = Post::where('tagid','4')->orderBy('id','desc')->paginate(8);
        //所有用户信息
        $users = UserHome::get();

        $postusers = [];
        //遍历 让他的id变成他的键
        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
        }
        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }

        // 显示视图 传参
        return view('Home.post.index',compact('plates','tags','post','postusers','postplates','author'));



    }

    //标签显示列表
    public function list(Request $request,$id)
    {
        
        $plates = Plates::get();
        //根据标签id显示帖子列表 根据id倒序 
        $posts = Post::where('tagid',$id)->orderBy('id','desc')->paginate(8);
        $users = UserHome::get();
        $tags = Tags::get();
        //获取点击量最高的作者 10人
        $author = Post::orderBy('clickcount','desc')->groupBy('uid')->limit(10)->get();

        $postusers = [];
        $tag = [];

        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
            $tag[$v->id] = $v->tagname;

        }

        $statu=['普通帖','活动贴','公告贴'];
        //显示视图
        return view('/home/post/list',compact('plates','posts','postusers','statu','tags','tag','id','author'));

    }
    //板块显示列表
    public function plateslist(Request $request,$id)
    {
        
        $plates = Plates::get();
        $posts = Post::where('pid',$id)->orderBy('id','desc')->paginate(10);
        $tags = Tags::get();
        $users = UserHome::get();
        $author = Post::orderBy('clickcount','desc')->groupBy('uid')->limit(10)->get();

        $postusers = [];

        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
        }

        $statu=['普通帖','活动贴','公告贴'];

        return view('/home/post/plateslist',compact('plates','posts','postusers','statu','tags','author'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 显示发表帖子页面
    public function create()
    {
        //        
        $pls = Plates::get();
        $childPlates = new ChildPlates();
        $cls = $childPlates ->get();
        $id = 0;

        $tag = Tags::get();



    return view('home/post/add',compact('pls','cls','id','tag'));



        // return view('/home/post/add');
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
        $post->uid = 1;
        $res = $post -> save();


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
        $userinfo = UserHome::get();
        $postinfo = Post::where('id',$id)->get();
        $users = [];
        foreach ($userinfo as $k => $v) {
            
            $users[$v->id] = $v->username;
        }

         $plates = Plates::get();

        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }

        $replay = Replay::where('postid',$id)->paginate(1);
        // $arr = [];
        // foreach ($replay as $k => $v) {
            

        //     if ($v->pid == $v->uid) {
                
        //         $arr[] = $v;
        //     }

 
        // }
        // dd($arr);
     


        return view('/home/post/detail',compact('postinfo','users','postplates','replay','plates'));

    }

    // 评论帖子
    public function replay(Request $request)
    {
 
     
        $input = $request->except('_token');


        $replay = new Replay();        
        $replay->uid = 1;
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
        $replay->uid = 1;
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

            if($v->uid == 1 && $v->postid == $input['postid']){
                $data=[
                  'status'=>2,
                  'msg'=>'已收藏'
                 ];

                 return $data;
                }
        }
        $mycollect = new Mycollect();        
        $mycollect->uid = 1;
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
    public function admire(Request $request){

               // $re = Post::where('id',$id)->update(['status'=>'0']); 

 
              
        $input = $request->except('_token');


        $postinfo = Post::where('id',$input['postid'])->get();
        $admire = ($postinfo[0]->admire)+1;






          // $info = Mycollect::get();
        // foreach ($info as $k => $v) {
        //     # code...

        //     if($v->uid == 1 && $v->postid == $input['postid']){
        //         $data=[
        //           'status'=>2,
        //           'msg'=>'已收藏'
        //          ];

        //          return $data;
        //         }
        // }
        $posts = new Post();        
        $posts->admire = $admire;
 
        $re = $posts->save();

         if($re){
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

     //帖子点赞
    public function tread(Request $request){

               // $re = Post::where('id',$id)->update(['status'=>'0']); 

 
              
        $data = $request->except('_token');

        // $info = Mycollect::get();
        // foreach ($info as $k => $v) {
        //     # code...

        //     if($v->uid == 1 && $v->postid == $input['postid']){
        //         $data=[
        //           'status'=>2,
        //           'msg'=>'已收藏'
        //          ];

        //          return $data;
        //         }
        // }
        // $mycollect = new Mycollect();        
        // $mycollect->uid = 1;
        // $mycollect->postid = $input['postid'];
        // $mycollect->collecttime = time();
 
        // $re = $mycollect->save();

        //  if($re){
        //   $data=[
        //       'status'=>0,
        //       'msg'=>'收藏成功'
        //   ];
        // }else{
        //     $data=[
        //         'status'=>1,
        //         'msg'=>'收藏失败'
        //     ];
        // }
          return  $data;

    }
}
