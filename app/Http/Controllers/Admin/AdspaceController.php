<?php

namespace App\Http\Controllers\Admin;

use App\Models\Adspace;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class adspaceController extends Controller
{
    /**
     * 广告管理控制器
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
        //显示广告界面
        $adspaces = Adspace::where('adpost','like','%'.$searchname.'%')->whereBetween('expiretime',[$mindate,$maxdate])->paginate(6);

        return view('admin.adspace.list',compact('adspaces','mindate','maxdate','searchname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 引入添加页面
        return view('admin.adspace.add');
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
            'adpost'=>'required',
            'adtag'=>'required',
            'adcontent'=>'required',
            'adimg'=>'required',
            'expiretime'=>'required|regex:/^\d{2}\/\d{2}\/\d{4}$/'
        ];
        $msg = [
            'adpost.required'=>'广告位置必须输入',
            'adtag.required'=>'广告标识必须输入',
            'adcontent.required'=>'文本内容必须输入',
            'adimg.required'=>'图片名称不存在',
            'expiretime.required'=>'过期时间必须选择',
            'expiretime.regex'=>'过期时间格式不正确'
        ];

        //进行手工表单验证

        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/adspace/create')
                ->withErrors($validator)
                ->withInput();
        }
        

        $adspace = new Adspace();

        $adspace -> adpost = $input['adpost'];
        $adspace -> adtag = $input['adtag'];
        $adspace -> adcontent = $input['adcontent'];
        $adspace -> expiretime = strtotime($input['expiretime']);
        // 本地服务器存储字段
        //    $plates -> imgfile = $input['imgfile'];
        // 阿里云OSS存储字段
        $adspace -> adimg = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['adimg'];

        $res = $adspace -> save();

        if ($res) {
            return redirect('admin/adspace');
        } else {
            return back()->with('errors','添加广告失败');
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
        $adspace = Adspace::find($id);
        return view('admin.adspace.edit',compact('adspace'));
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
        // dd(13123123213);
        // 接收表单数据
        $input = $request->except('_token','file_upload');

        $rule=[
            'adpost'=>'required',
            'adtag'=>'required',
            'adcontent'=>'required',
            'adimg'=>'required',
            'expiretime'=>'required|regex:/^\d{2}\/\d{2}\/\d{4}$/'
        ];
        $msg = [
            'adpost.required'=>'广告位置必须输入',
            'adtag.required'=>'广告标识必须输入',
            'adcontent.required'=>'文本内容必须输入',
            'adimg.required'=>'图片名称不存在',
            'expiretime.required'=>'过期时间必须选择',
            'expiretime.regex'=>'过期时间格式不正确'
        ];

        //进行手工表单验证

        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/adspace/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $adspace = Adspace::find($id);

        if ($request -> hasFile('file_upload')) {
            // 本地服务器存储字段
            //    $plates -> imgfile = $input['imgfile'];
            // 阿里云OSS存储字段
            $adspace -> adimg = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['adimg'];
        }

        $adspace -> adpost = $input['adpost'];
        $adspace -> adtag = $input['adtag'];
        $adspace -> adcontent = $input['adcontent'];
        $adspace -> expiretime = strtotime($input['expiretime']);

        $res = $adspace -> save();

        if ($res) {
            return redirect('admin/adspace');
        } else {
            return back()->with('errors','修改广告失败');
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
        $adspace = Adspace::find($id);
        //执行删除操作
        $res = $adspace->delete();
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
