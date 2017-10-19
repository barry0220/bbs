<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserHome;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


//        $user =DB::table('user')->paginate(2);

        $num = $request->input('pagea')?$request->input('pagea'): 3;
        //
        $input = $request->input('username')?$request->input('username'):'';

        $isvip = $request->input('isvip');

//        dd($isvip);
//        $user = UserHome::where('username','like','%'.$input.'%')->paginate($num);

        $user = \DB::table('user')
            ->leftjoin('user_detail','user_detail.uid','=','user.id')
            ->where('username','like','%'.$input.'%')
            ->where('isvip','like','%'.$isvip.'%')
            ->select('user.*','user_detail.isvip')
            ->paginate($num);

        $vip = ['否','是'];
//        dd($user[0]->isvip);

//        dd($vip[$user[0]->isvip]);
        return view('admin.userhome.index',compact('user','input','num','vip','isvip'));

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
        //
        $user = UserHome::find($id);
        $userdetail = UserHome::find($id)->details;

//        dd($user);
        return view('admin.userhome.detail',compact('user','userdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取要修改的那条记录
        $user = UserHome::find($id);
        //dd($user);

        return view('admin/userhome/edit',compact('user'));
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
        //dd(11111);
        //接收要修改的记录的内容和id
//        dd($request->all());
        $input_name = $request->input('username');
        $input_phone = $request->input('phone');
        $input_email = $request->input('email');

        $user = UserHome::find($id);


        $user->username = $input_name;
        $user->phone = $input_phone;
        $user->email = $input_email;

        $re = $user->save();

        //4.判断执行是否成功
        if ($re) {
            return redirect('admin/userhome');
        }else {
            return redirect('admin/userhome/edit')->with('msg','用户信息修改失败');
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
        //查询要删除的记录的模型
        $user = UserHome::find($id);
        //执行删除操作
        $res = $user->delete();
        //根据返回的结果处理成功和失败
        if($res){
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

        $re = UserHome::where('id',$id)->update(['status'=>'1']);

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

        $re = UserHome::where('id',$id)->update(['status'=>'0']);

        if($re){
            $data=[
                'status'=>0,
                'msg'=>'开启成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'开启失败'
            ];
        }
        return  $data;




    }
}
