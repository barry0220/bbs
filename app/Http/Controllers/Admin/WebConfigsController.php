<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebConfigs;
use App\Services\OSS;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WebConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //显示标签界面
        $webconfig = WebConfigs::get()->first();

        return view('admin.webconfigs.list',compact('webconfig'));
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
        //接收传来的数据并修改

        //接收表单数据
        $input = $request->except('_token','file_upload');

        $rule=[
            'title'=>'required',
            'law'=>'required',
            'copyright'=>'required',
            'logofile'=>'required'
        ];
        $msg = [
            'title.required'=>'板块名必须输入',
            'law.required'=>'图片名称不存在',
            'copyright.required'=>'板块名必须输入',
            'logofile.required'=>'图片名称不存在'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/webconfigs/')
                ->withErrors($validator)
                ->withInput();
        }

        $webconfig = WebConfigs::find($id);

        $webconfig -> title = $input['title'];
        $webconfig -> law = $input['law'];
        $webconfig -> copyright = $input['copyright'];
        //检查是否上传了新图片,未上传的话不执行图片修改
        if ($request -> hasFile('file_upload')) {
            //        本地服务器存储字段
            //$tags -> imgfile = $input['imgfile'];
            //阿里云OSS存储字段
            $webconfig -> logofile = 'http://bbs189.oss-cn-beijing.aliyuncs.com'.$input['logofile'];
        }


        $res = $webconfig -> save();

        if ($res) {
            //调用putfile方法写如配置文档
            $this->putFile();
            return redirect('admin/webconfigs');
        } else {
            return back()->with('errors','修改配置失败');
        }
    }
    /**
     * 从数据库中读取配置放入webconfig.php.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putFile()
    {
        //将配置文件中的内容写入config目录下的webconfig.php文件   方便后期读取网站配置
        $config = WebConfigs::first()['attributes'];
        //dd($config);
        //die;
        $str = '<?php return '.var_export($config,true).';';
        //要写入的路径
        $path = base_path().'\config\webconfig.php';
        //参数1 写入的文件的路径  参数2  向文件中写入的内容
        file_put_contents($path,$str);
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
