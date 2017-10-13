<?php

namespace App\Http\Controllers\Admin;

use App\Models\Runimg;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RunImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 如果存在条件接收条件
        $input = $request -> all();

        $mindate = isset($input['mindate']) ? strtotime($input['mindate']) : time()-60*60*24*30;   //默认查询向前一月时间
        $maxdate = isset($input['maxdate']) ? strtotime($input['maxdate']) : time()+60*60*24*30; //默认查询向后一月的时间
        $searchname = isset($input['searchname']) ? $input['searchname'] : '';
        // dd($input['mindate']);

        //开启sql语句日志
        // \DB::connection()->enableQueryLog();

        //显示广告界面
        $runimgs = Runimg::where('name','like','%'.$searchname.'%')->whereBetween('expiretime',[$mindate,$maxdate])->paginate(6);

        //打印sql语句
        // $log = \DB::getQueryLog();
        // dd($log);

        return view('admin.runimg.list',compact('runimgs','mindate','maxdate','searchname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 引入添加页面
        return view('admin.runimg.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接收表单数据
        $input = $request->except('_token','file_upload');

        if (!$request -> hasFile('file_upload')) {
            return back()->with('errors', '没有选择图片')->withInput();
        }

        $rule=[
            'name'=>'required',
            'postid'=>'required',
            'imgfile'=>'required',
            'expiretime'=>'required|regex:/^\d{2}\/\d{2}\/\d{4}$/'
        ];
        $msg = [
            'name.required'=>'模版名称必须输入',
            'postid.required'=>'关联帖子ID必须输入',
            'imgfile.required'=>'图片名称不存在',
            'expiretime.required'=>'过期时间必须选择',
            'expiretime.regex'=>'过期时间格式不正确'
        ];

        //进行手工表单验证

        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/runimg/create')
                ->withErrors($validator)
                ->withInput();
        }


        $runimg = new Runimg();

        $runimg -> name = $input['name'];
        $runimg -> postid = $input['postid'];
        $runimg -> expiretime = strtotime($input['expiretime']);
        // 本地服务器存储字段
        //    $plates -> imgfile = $input['imgfile'];
        // 阿里云OSS存储字段
        $runimg -> imgfile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['imgfile'];

        $res = $runimg -> save();

        if ($res) {
            return redirect('admin/runimg');
        } else {
            return back()->with('errors','添加轮播图失败');
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
        // 显示修改界面
        $runimg = Runimg::find($id);
        return view('admin.runimg.edit',compact('runimg'));
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
        // 接收表单数据
        $input = $request->except('_token','file_upload');
        // dd($input);
        $rule=[
            'name'=>'required',
            'postid'=>'required',
            'imgfile'=>'required',
            'expiretime'=>'required|regex:/^\d{2}\/\d{2}\/\d{4}$/'
        ];
        $msg = [
            'name.required'=>'模版名称必须输入',
            'postid.required'=>'关联帖子ID必须输入',
            'imgfile.required'=>'图片名称不存在',
            'expiretime.required'=>'过期时间必须选择',
            'expiretime.regex'=>'过期时间格式不正确'
        ];

        //进行手工表单验证

        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/runimg/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $runimg = Runimg::find($id);

        if ($request -> hasFile('file_upload')) {
            // 本地服务器存储字段
            //    $plates -> imgfile = $input['imgfile'];
            // 阿里云OSS存储字段
            $runimg -> imgfile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['imgfile'];
        }

        $runimg -> name = $input['name'];
        $runimg -> postid = $input['postid'];
        $runimg -> expiretime = strtotime($input['expiretime']);

        $res = $runimg -> save();

        if ($res) {
            return redirect('admin/runimg');
        } else {
            return back()->with('errors','修改轮播图失败');
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
        $runimg = Runimg::find($id);
        //执行删除操作
        $res = $runimg->delete();
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
