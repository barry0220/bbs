<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Models\Plates;
use App\Models\Tags;
use App\Models\Post;
use App\Models\Replay;
use App\Models\UserHome;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 板块 原创帖文显示
        $plates = Plates::get();

        // $posts1 = Post::orderBy('clickcount','desc')->limit(0,5)->get();
        // $posts2 = Post::orderBy('clickcount','desc')->limit(10)->get();
        $posts1 = Post::orderBy('clickcount','desc')->limit(10)->get();




        $tags = Tags::get();

        $post = Post::where('tagid','2')->paginate(8);

        $users = UserHome::get();

        $postusers = [];

        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
        }
        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }

        return view('Home.post.index',compact('plates','tags','post','postusers','postplates','posts1'));
    }
    // 猫眼观察显示列表
    public function cateye()
    {
        # code...
         $plates = Plates::get();

        $posts1 = Post::orderBy('clickcount','desc')->limit(10)->get();

        $tags = Tags::get();

        $post = Post::where('tagid','4')->paginate(8);

        $users = UserHome::get();

        $postusers = [];

        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
        }
        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }

        return view('Home.post.index',compact('plates','tags','post','postusers','postplates','posts1'));



    }
    //标签显示列表
    public function list(Request $request,$id)
    {
        
        $plates = Plates::get();
        $posts = Post::where('tagid',$id)->get();
        $users = UserHome::get();

        $postusers = [];

        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
        }

        $statu=['普通帖','活动贴','公告贴'];

        return view('/home/post/list',compact('plates','posts','postusers','statu'));

    }
 //板块显示列表
    public function plateslist(Request $request,$id)
    {
        
        $plates = Plates::get();
        $posts = Post::where('pid',$id)->get();
        
        $users = UserHome::get();

        $postusers = [];

        foreach ($users as $k => $v) {
            $postusers[$v->id] = $v->username;
        }

        $statu=['普通帖','活动贴','公告贴'];

        return view('/home/post/plateslist',compact('plates','posts','postusers','statu'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('/home/post/add');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //帖子详情页

        $userinfo = UserHome::get();
        $postinfo = Post::where('id',$id)->get();
        // $postinfo[0]->content = htmlspecialchars($postinfo[0]->content);
        $users = [];
        foreach ($userinfo as $k => $v) {
            
            $users[$v->id] = $v->username;
        }

         $plates = Plates::get();

        $postplates = [];
        foreach ($plates as $k => $v) {
            
            $postplates[$v->id] = $v->pname;
        }

        $replay = Replay::where('postid',$id)->paginate(10);

        return view('/home/post/detail',compact('postinfo','users','postplates','replay','plates'));

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
}
