<?php

namespace App\Http\Controllers\Admin;

use App\Services\OSS;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{
    /**
     *图片上传OSS服务器
     *
     */
    public function upload($type)
    {
        //return Input::all();
        //获取上传的文件对象
        $file = Input::file('file_upload');
        //判断文件是否有效
        if ($file->isValid()) {
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
            //本地服务器保存图片
            //$path = $file->move(public_path().'/uploads',$newName);
            //阿里云服务器OSS保存图片
            $pic = $file->getRealPath();
            $result = OSS::upload('uploads/img/'.$type.'/' . $newName, $pic);

            $filepath = 'uploads/img/'.$type.'/' . $newName;
            //返回文件的路径
            return $filepath;
        }
    }
}
