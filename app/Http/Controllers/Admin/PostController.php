<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Admin\Post;
use App\Model\Admin\User;
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

          $input = $request->input('title')?$request->input('title'):'';
        // $_GET
          
          $num = $request->input('pagea')?$request->input('pagea'): 10;

        $res = DB::table('post')
            ->leftJoin('user', 'post.uid', '=', 'user.id')
            ->leftJoin('plates','post.pid','=','plates.id')
            ->leftJoin('childplates','post.cid','=','childplates.id')
            ->select('post.*','plates.pname','user.username','childplates.cname')->where('title','like','%'.$input.'%')->paginate($num);
        //转换状态
        $statu = ['普通帖','活动贴','公告贴'];

       // print_r($_GET);





        //显示视图
        return view('Admin.post.index',compact('res','statu','num','input'));
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
        //查询出一条数据的所有内容
        $res = DB::table('post')
            ->leftJoin('user', 'post.uid', '=', 'user.id')
            ->leftJoin('plates','post.pid','=','plates.id')
            ->leftJoin('childplates','post.cid','=','childplates.id')
            ->select('post.*','plates.pname','user.username','childplates.cname')->where('post.id',$id)->get();
        //转换状态
        $postcode = ['普通帖','活动贴','公告贴'];
        $status=['正常','已删除'];

        // echo "<pre>";
        // print_r($res);

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
        //
           $res = DB::table('post')
            ->leftJoin('user', 'post.uid', '=', 'user.id')
            ->leftJoin('plates','post.pid','=','plates.id')
            ->leftJoin('childplates','post.cid','=','childplates.id')
            ->select('post.*','plates.pname','user.username','childplates.cname')->where('post.id',$id)->get();
        //转换状态
        $postcode = ['普通帖','活动贴','公告贴'];
        $status=['正常','已删除'];

        return view('Admin.post.edit',compact('res','status','postcode'));

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
        $data = $request->except('_token','_method');

        // dd($data);
        $res = DB::table('post')->where('id',$id)->update($data);
        if($res){
            return "成功";

        } else {
            return "失败";
        }
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
