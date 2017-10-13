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
            $result = OSS::upload('uploads/img/plates/'.$newName, $pic);

            $filepath = 'uploads/img/plates/'.$newName;
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

        $ncpls = array();
        //重写二级模板格式
        foreach ($cpls as $k => $v){
            $cpls[$k]['cname'] = '　　|--'.$cpls[$k]['cname'];
        }

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
        $pls = Plates::get();
        $id = 0;

        //引入添加页面
        return view('admin.plates.add',compact('pls','id'));
    }

    //添加子类执行方法
    public function childadd($id)
    {
        $pls = Plates::get();
//        $mes = "这是自定义方法";
        return view('admin.plates.add',compact('pls','id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收表单数据
        $input = $request->except('_token','file_upload');

        $id = $input['id'];
//        dd($id);
        //首先判断是否为一级板块
        if ($id == '0') {
            //添加一级板块进行的操作
            if (!$request -> hasFile('file_upload')) {
                return back()->with('errors', '没有选择图片')->withInput();
            }

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



            $plates = new Plates();

            $plates -> pname = $input['pname'];
//        本地服务器存储字段
            $plates -> imgfile = $input['imgfile'];
//        阿里云OSS存储字段
            $plates -> imgfile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['imgfile'];
            $plates -> isvip = $input['isvip'];
            $res = $plates -> save();
        } else {

            //添加二次板块进行的操作
            $rule=[
                'pname'=>'required'
            ];
            $msg = [
                'pname.required'=>'板块名必须输入'
            ];

//        进行手工表单验证
            $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
            if ($validator->fails()) {
                return redirect('admin/plates/create')
                    ->withErrors($validator)
                    ->withInput();
            }



            $cplates = new ChildPlates();
            $cplates -> cname = $input['pname'];
            $cplates -> pid = $id;

            $res = $cplates -> save();
        }

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
        //显示界面
        $pls = Plates::find($id);
        return view('admin.plates.edit',compact('pls'));
    }
    //二级板块修改引入界面
    public function childedit($id)
    {
        //显示界面
        $cpls = ChildPlates::find($id);
        $pls = Plates::get();

//        dd($pls);
//        var_dump($cpls);
//        die;

        return view('admin.plates.childedit',compact('cpls','pls'));
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
        //接收传来的数据并修改

        //接收表单数据
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
            return redirect('admin/plates/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }



        $plates = Plates::find($id);

        $plates -> pname = $input['pname'];
        //检查是否上传了新图片,未上传的话不执行图片修改
        if ($request -> hasFile('file_upload')) {
            //        本地服务器存储字段
            $plates -> imgfile = $input['imgfile'];
            //阿里云OSS存储字段
            $plates -> imgfile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['imgfile'];
        }

        $plates -> isvip = $input['isvip'];

        $res = $plates -> save();

        if ($res) {
            return redirect('admin/plates');
        } else {
            return back()->with('errors','修改板块失败');
        }

    }

    //二级板块执行修改
    public function childdoedit(Request $request,$id)
    {
        //接收上传的数据
        $input= $request -> except('_token');
        //验证数据是否合法
        $rule=[
            'cname'=>'required'
        ];
        $msg = [
            'cname.required'=>'板块名必须输入'
        ];

//        进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
        if ($validator->fails()) {
            return redirect('admin/childedit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $cplates = ChildPlates::find($id);

        $cplates -> pid = $input['pid'];
        $cplates -> cname = $input['cname'];

        $res = $cplates -> save();
        if ($res) {
            return redirect('admin/plates');
        } else {
            return back()->with('errors','修改板块失败');
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
        //查询要删除的记录的模型
        $plates = Plates::find($id);
        $cpls = ChildPlates::where('pid',$id)->first();

        //判断有没有下级板块,如果有不允许删除
        if ($cpls) {
            $data=[
                'status'=>1,
                'msg'=>'该板块存在子板块,不允许删除'
            ];
            return  $data;
        }



        //执行删除操作
        $res = $plates->delete();
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

    //二级板块删除
    public function childdel($id)
    {
        //查询要删除的记录的模型
        $cplates = ChildPlates::find($id);
        //执行删除操作
        $res = $cplates->delete();
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
