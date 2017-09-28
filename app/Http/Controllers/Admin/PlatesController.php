<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChildPlates;
use App\Models\Plates;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Services\OSS;

class PlatesController extends Controller
{
    /**
     *图片上传本地服务器
     *
     */
    public function upload()
    {
        //获取上传的文件对象
        $file = Input::file('file_upload');
        //判断文件是否有效
        if($file->isValid()){
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
//            本地服务器保存图片
//            $path = $file->move(public_path().'/uploads',$newName);
//            阿里云服务器OSS保存图片
            $pic = $file->getRealPath();
            $result = OSS::upload('uploads/'.$newName, $pic);

            $filepath = 'uploads/'.$newName;
            //返回文件的路径
            return  $filepath;
        }
    }

    /**
     * 引入板块列表页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询板块
//        $pls = DB::table('plates')->get();
//        $cpls = DB::table('childplates')->get();

        $pls = Plates::get();
        $cpls = ChildPlates::get();

        //引入页面
        return view('admin.plates.list',compact('pls','cpls'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //引入添加页面
//        dd(base_path());
        return view('admin.plates.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request -> hasFile('file_upload')){
            return back() -> with('errors','没有选择图片')->withInput();
        }

        $input = $request->except('_token','file_upload');


        $rule=[
            'pname'=>'required',
            'imgfile'=>'required'
        ];
        $msg = [
            'pname.required'=>'板块名必须输入',
            'imgfile.required'=>'图片名称不存在'
        ];

//        进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
        if ($validator->fails()) {
            return redirect('admin/plates/create')
                ->withErrors($validator)
                ->withInput();
        }

        //接收表单数据

        $plates = new Plates();

        $plates -> pname = $input['pname'];
        $plates -> imgfile = $input['imgfile'];
        $plates -> isvip = $input['isvip'];
        $res = $plates -> save();

        if ($res) {
            return redirect('admin/plates');
        } else {
            return back()->with('errors','添加板块失败');
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
