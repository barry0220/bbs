<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Warwork;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;


class WarworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num = $request->input('pagea')?$request->input('pagea'): 10;
        //
        $input = $request->input('works')?$request->input('works'):'';

        $war = Warwork::where('works','like','%'.$input.'%')->paginate($num);
        // dd($war);

        return view('Admin.warwork.list',compact('war','input','num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Warwork.add');

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
        $input = $request->except('_token');
        
        // dd($input);        
        $rule=[
            'works'=>'required'
        ];
        $msg =[
            'works.required'=>'敏感词必须填写'
        ];
        // 进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
        if($validator->fails()){
            return redirect('admin/warwork/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        $warwork = new Warwork();

        $warwork -> works = $input['works'];

        $res = $warwork -> save();

        if ($res) {
            return redirect('admin/warwork');
        } else {
            return back()->with('errors','添加敏感词失败');
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
        //
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
        $warwork = Warwork::find($id);
        return view('Admin.Warwork.edit',compact('warwork'));

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
        //接收上传的数据,过滤掉token和method
        $input = $request->except('_token','_method');
        
        // dd($input);        
        $rule=[
            'works'=>'required'
        ];
        $msg =[
            'works.required'=>'敏感词必须填写'
        ];
        // 进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
        if($validator->fails()){
            return redirect('admin/warwork/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        $warwork = Warwork::find($id);
        $warwork -> works = $input['works'];

        $res = $warwork -> save();

        if ($res) {
            return redirect('admin/warwork');
        } else {
            return back()->with('errors','添加敏感词失败');
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
        $warwork = Warwork::find($id);
        //执行删除操作
        $res = $warwork->delete();
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
}
