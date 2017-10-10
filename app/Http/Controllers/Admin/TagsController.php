<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tags;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Services\OSS;
use phpDocumentor\Reflection\DocBlock\Tag;

class TagsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //显示标签界面
        $tags = Tags::paginate(6);

        return view('admin.tags.list',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //引入添加页面
        return view('admin.tags.add');
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

            //添加标签进行的操作
            //判断是否存在图片
//        dd($_FILES);
//        if($request->hasFile('file_upload')){
//            dd('有');
//        } else {
//            dd('没有');
//        }
            if (!$request -> hasFile('file_upload')) {
                return back()->with('errors', '没有选择图片')->withInput();
            }

            $rule=[
                'tagname'=>'required',
                'imgfile'=>'required'
            ];
            $msg = [
                'tagname.required'=>'标签名必须输入',
                'imgfile.required'=>'图片名称不存在'
            ];

//        进行手工表单验证

            $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
            if ($validator->fails()) {
                return redirect('admin/tags/create')
                    ->withErrors($validator)
                    ->withInput();
            }



            $tags = new Tags();

            $tags -> tagname = $input['tagname'];
//        本地服务器存储字段
//            $plates -> imgfile = $input['imgfile'];
//        阿里云OSS存储字段
            $tags -> imgfile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['imgfile'];

            $res = $tags -> save();

        if ($res) {
            return redirect('admin/tags');
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
        //显示修改界面
        $tag = Tags::find($id);
        return view('admin.tags.edit',compact('tag'));
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
            'tagname'=>'required',
            'imgfile'=>'required'
        ];
        $msg = [
            'tagname.required'=>'板块名必须输入',
            'imgfile.required'=>'图片名称不存在'
        ];

//        进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
        if ($validator->fails()) {
            return redirect('admin/tags/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }



        $tags = Tags::find($id);

        $tags -> tagname = $input['tagname'];
        //检查是否上传了新图片,未上传的话不执行图片修改
        if ($request -> hasFile('file_upload')) {
            //        本地服务器存储字段
            //$tags -> imgfile = $input['imgfile'];
            //阿里云OSS存储字段
            $tags -> imgfile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['imgfile'];
        }


        $res = $tags -> save();

        if ($res) {
            return redirect('admin/tags');
        } else {
            return back()->with('errors','修改标签失败');
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
        $tag = Tags::find($id);
        //执行删除操作
        $res = $tag->delete();
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
