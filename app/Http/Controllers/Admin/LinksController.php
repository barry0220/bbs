<?php

namespace App\Http\Controllers\Admin;

use App\Models\Links;
use Guzzle\Http\Message\Header\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
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
        $searchname = isset($input['searchname']) ? $input['searchname'] : '';
        //显示链接界面
        $links = Links::where('linkname','like','%'.$searchname.'%')->paginate(6);

        return view('admin.links.list',compact('links','searchname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //显示添加链接界面
        return view('admin.links.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收上传的数据
        $input= $request-> except('_token');
        //添加二次板块进行的操作
        $rule=[
            'linkname'=>'required',
            'link'=>['regex:/^(http|https)\:\/\/\w+\.\w+\.(com|cn|org|cc)$/']

        ];
        $msg = [
            'linkname.required'=>'链接名必须输入',
            'link.regex'=>'链接地址输入格式错误'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/links/create')
                ->withErrors($validator)
                ->withInput();
        }

        $links = new Links();
        $links -> linkname = $input['linkname'];
        $links -> link = $input['link'];

        $res = $links -> save();

        if ($res) {
            //调用putfile方法写如配置文档
            $this->putFile();
            return redirect('admin/links');
        } else {
            return back()->with('errors','添加链接失败');
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
        $links = Links::find($id);
        return view('admin.links.edit',compact('links'));
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
        //dd(12312312312);
        //接收上传的数据
        $input= $request-> except('_token','_method');

        //dd($input);
        //添加二次板块进行的操作
        $rule=[
            'linkname'=>'required',
            'link'=>['regex:/^(http|https)\:\/\/\w+\.\w+\.(com|cn|org|cc)$/']

        ];
        $msg = [
            'linkname.required'=>'链接名必须输入',
            'link.regex'=>'链接地址输入格式错误'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/links')->withErrors($validator)->withInput();
        }

        $links = Links::find($id);
        $links -> linkname = $input['linkname'];
        $links -> link = $input['link'];

        $res = $links -> save();

        if ($res) {
            //调用putfile方法写如配置文档
            $this->putFile();
            return redirect('admin/links');
        } else {
            return back()->with('errors','修改友情链接失败');
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
        $links = Links::find($id);
        //执行删除操作
        $res = $links->delete();
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

    public function putFile()
    {
        //将配置文件中的内容写入config目录下的webconfig.php文件   方便后期读取网站配置
        $links = Links::lists('linkname','link')->all();
        // dd($links);
        //die;
        $str = '<?php return '.var_export($links,true).';';
        //要写入的路径
        $path = base_path().'\config\linksconfig.php';
        //参数1 写入的文件的路径  参数2  向文件中写入的内容
        file_put_contents($path,$str);
    }
}
