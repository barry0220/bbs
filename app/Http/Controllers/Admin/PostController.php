<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Plates;
use App\Models\ChildPlates;
use App\User;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 查询

        //   $input = $request->input('title')?$request->input('title'):'';
        //
        //
        //   $pid = $request->input('pid')?$request->input('pid'):'';
        //
        //   $cid = $request->input('cid')?$request->input('cid'):'';
        //
        //   $num = $request->input('pagea')?$request->input('pagea'): 10;
        //
        // if ($pid == '0' || $pid == '' ||$cid == '0'|| $cid == '') {
        //     $res = DB::table('post')
        //     ->leftJoin('user', 'post.uid', '=', 'user.id')
        //     ->leftJoin('plates','post.pid','=','plates.id')
        //     ->leftJoin('childplates','post.cid','=','childplates.id')
        //     ->select('post.*','plates.pname','user.username','childplates.cname')
        //         ->where('post.pid','>',$pid)->where('post.cid','>',$cid)
        //         ->where('title','like','%'.$input.'%')
        //         ->paginate($num);
        // } else {
        //     $res = DB::table('post')
        //     ->leftJoin('user', 'post.uid', '=', 'user.id')
        //     ->leftJoin('plates','post.pid','=','plates.id')
        //     ->leftJoin('childplates','post.cid','=','childplates.id')
        //     ->select('post.*','plates.pname','user.username','childplates.cname')
        //         ->where('post.pid',$pid)
        //         ->where('post.cid',$cid)->where('title','like','%'.$input.'%')
        //         ->paginate($num);
        // }


        $input = $request->input('title');


        $pid = $request->input('pid');

        $cid = $request->input('cid');

        $num = $request->input('pagea')?$request->input('pagea'): 10;


        $res = DB::table('post')
            ->leftJoin('user', 'post.uid', '=', 'user.id')
            ->leftJoin('plates','post.pid','=','plates.id')
            ->leftJoin('childplates','post.cid','=','childplates.id')
            ->select('post.*','plates.pname','user.username','childplates.cname')
            ->where('post.pid','like','%'.$pid.'%')
            ->where('post.cid','like','%'.$cid.'%')
            ->where('title','like','%'.$input.'%')
            ->paginate($num);
        //转换状态
        $statu = ['普通帖','活动贴','公告贴'];


        $pls = Plates::get();

        $cls = ChildPlates::get();
        // $id = 0;


        //显示视图
        return view('Admin.post.index',compact('res','statu','num','input','pls','cls','id','pid','cid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // dd(Post::find($id));
        //查询出一条数据的所有内容
        $res = DB::table('post')
            ->leftJoin('user', 'post.uid', '=', 'user.id')
            ->leftJoin('plates','post.pid','=','plates.id')
            ->leftJoin('childplates','post.cid','=','childplates.id')
            ->select('post.*','plates.pname','user.username','childplates.cname')->where('post.id',$id)->get();
               //转换int类型
            // dd($res[0]->status);
             // $time = intval($res[0]->posttime);
         //转换状态
        $postcode = ['普通帖','活动贴','公告贴'];
        $status=['正常','已删除'];

        return view('Admin.post.show',compact('res','status','postcode'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     


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

        // $re = DB::table('post')->where('id',$id)->delete();
     //查询要删除的记录的模型执行删除操作
        $re = Post::where('id',$id)->delete();

        
        //根据返回的结果处理成功和失败
        if($re){
          $data=[
              'status'=>0,
              'msg'=>'删除成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
          return  $data;
    }
    //更改状态为禁用
    public function disables($id)
    {
        # code...

        $re = Post::where('id',$id)->update(['status'=>'1']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'禁用成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'禁用失败'
            ];
        }
          return  $data;




    }

     //更改状态为开启
    public function open($id)
    {
        # code...

        $re = Post::where('id',$id)->update(['status'=>'0']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'禁用成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'禁用失败'
            ];
        }
          return  $data;




    }
         //更改状态为加精
    public function good($id)
    {
        # code...

        $re = Post::where('id',$id)->update(['good'=>'1']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'失败'
            ];
        }
          return  $data;




    }
         //更改状态为不加精
    public function nogood($id)
    {
        # code...

        $re = Post::where('id',$id)->update(['good'=>'0']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'失败'
            ];
        }
          return  $data;




    }
         //更改状态为置顶
    public function stick($id)
    {
        # code...

        $re = Post::where('id',$id)->update(['stick'=>'1']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'失败'
            ];
        }
          return  $data;




    }
         //更改状态为不置顶
    public function nostick($id)
    {
        # code...

        $re = Post::where('id',$id)->update(['stick'=>'0']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'禁用成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'禁用失败'
            ];
        }
          return  $data;




    }

}
