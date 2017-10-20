<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Post;
use App\Models\Plates;
use App\Models\Tags;
use App\Models\ChildPlates;
use App\User;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ActiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
           // 查询

          $input = $request->input('title')?$request->input('title'):'';


          $pid = $request->input('pid')?$request->input('pid'):'';

          $cid = $request->input('cid')?$request->input('cid'):'';
        // $_GET
          // $pid = $pid!=0?$pid:'';
          
          $num = $request->input('pagea')?$request->input('pagea'): 10;
          $postcodes = '2';
          $postcode = '1 ';

        // if ($pid == '0' || $pid == '' ||$cid == '0'|| $cid == '') {
        //     $res = DB::table('post')
        //     ->leftJoin('user', 'post.uid', '=', 'user.id')
        //     ->leftJoin('plates','post.pid','=','plates.id')
        //     ->leftJoin('childplates','post.cid','=','childplates.id')
        //     ->select('post.*','plates.pname','user.username','childplates.cname')
        //         ->where('post.pid','>',$pid)
        //         ->whereIn('post.postcode',['1','2'])
        //         ->where('post.cid','>',$cid)
        //         ->where('title','like','%'.$input.'%')
        //         ->orderBy('id','desc')
        //         ->paginate($num);
        // } else {
        //     $res = DB::table('post')
        //     ->leftJoin('user', 'post.uid', '=', 'user.id')
        //     ->leftJoin('plates','post.pid','=','plates.id')
        //     ->leftJoin('childplates','post.cid','=','childplates.id')
        //     ->select('post.*','plates.pname','user.username','childplates.cname')
        //         ->where('post.pid',$pid)
        //         ->where('post.postcode',$postcode)
        //         ->where('post.cid',$cid)
        //         ->where('title','like','%'.$input.'%')
        //         ->orderBy('id','desc')
        //         ->paginate($num);
        // }

        $res = DB::table('post')
            ->leftJoin('user', 'post.uid', '=', 'user.id')
            ->leftJoin('plates','post.pid','=','plates.id')
            ->leftJoin('childplates','post.cid','=','childplates.id')
            ->select('post.*','plates.pname','user.username','childplates.cname')
            ->where('post.pid','like','%'.$pid.'%')
            ->whereIn('post.postcode',['1','2'])
            ->where('post.cid','like','%'.$cid.'%')
            ->where('title','like','%'.$input.'%')
            ->orderBy('id','desc')
            ->paginate($num);
        //转换状态
        $statu = ['普通帖','活动贴','公告贴'];


        $plates = new Plates();


        $pls = $plates->get();
        $childPlates = new ChildPlates();
        $cls = $childPlates ->get();
        $id = 0;


        //显示视图
        return view('Admin.active.index',compact('res','statu','num','input','pls','cls','id','pid','cid','postcode'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $pls = Plates::get();
        $childPlates = new ChildPlates();
        $cls = $childPlates ->get();
        $id = 0;

        $tag = Tags::get();



    return view('admin/active/add',compact('pls','cls','id','tag'));


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
        // dd($request->all());
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
        // dd($validator->fails());
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
        $post->good = $input['good'];
        $post->goodtime =time();
        $post->stick = $input['stick'];
        $post->sticktime =time();
        $post->status = $input['status'];
        $post->postcode = $input['postcode'];
        $post->content = $input['content'];
        $post->uid = 1;
        $res = $post -> save();


        if ($res) {
            return redirect('admin/active');
        } else {
            // return back()->with('errors','发表活动贴失败');
            return redirect('admin/active/create')->with('msg','发表活动贴失败');

        }




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
        //转换状态
        // $postcode = ['普通帖','活动贴','公告贴'];
        // $status=['正常','已删除'];
               // dd($res[0]->status);

        return view('Admin.active.show',compact('res','status','postcode'));

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
        //查询出一条数据的所有内容
        $res = DB::table('post')
            ->leftJoin('user', 'post.uid', '=', 'user.id')
            ->leftJoin('plates','post.pid','=','plates.id')
            ->leftJoin('childplates','post.cid','=','childplates.id')
            ->select('post.*','plates.pname','user.username','childplates.cname')->where('post.id',$id)->get();

        //转换状态
        $postcode = ['普通帖','活动贴','公告贴'];
        $status=['正常','已删除'];

        $tag = Tags::get();
        $pls = Plates::get();
        $childPlates = new ChildPlates();
        $cls = $childPlates ->get();
        $id = 0;

        return view('Admin.active.edit',compact('res','status','postcode','tag','id','pls','cls',''));



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

        $input = $request->except('_token','_method');

        // dd($input);
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
        // dd($validator->fails());
        if($validator->fails()) {
            return redirect('admin/active/create')
                ->withErrors($validator)
                ->withInput();

        }


        $post = Post::find($id);
        $post->title = $input['title'];
        $post->pid = $input['pid'];
        $post->posttime =time();
        $post->keywords = $input['keywords'];
        $post->cid = $input['cid'];
        $post->good = $input['good'];
        $post->goodtime = time();
        $post->stick = $input['stick'];
        $post->sticktime = time();
        $post->status = $input['status'];
        $post->postcode = $input['postcode'];
        $post->content = $input['content'];
        $post->uid = 1;
        $res = $post->save();


        if ($res) {
            return redirect('admin/active');
        } else {
            // return back()->with('errors','发表活动贴失败');
            return redirect('admin/active/edit')->with('msg','发表活动贴失败');

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

        $re = DB::table('post')->where('id',$id)->delete();
     //查询要删除的记录的模型
        // $post = Post::find($id);

        //执行删除操作
        // $re = $post->delete();
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
}
