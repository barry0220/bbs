@extends('Layouts.admin')

@section("title","论坛管理 | 板块修改")

@section("content")
    <style>
        .form-horizontal{
            margin-top:50px;
        }
    </style>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @if(is_object($errors))
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @else
                    <li>{{ session('errors') }}</li>
                @endif
            </ul>
        </div>
    @endif
    <form method="post" id="art_form" action="{{ url('admin/plates/update/').'/'.$pls->id  }}" class="form-horizontal" enctype="multipart/form-data">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">板块名称</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="pname" value="{{$pls -> pname}}"">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div id="one">
            <div class="form-group">
                <label class="col-sm-2 control-label">板块图像</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="art_thumb" name="imgfile" value="{{$pls->imgfile}}">
                    <p><img id="img1" alt="上传后显示图片"  src="{{$pls->imgfile}}" style="max-width:350px;max-height:100px;" /></p>
                </div>
                <div class="col-sm-1">
                    <input id="file_upload" type="file" name="file_upload" multiple="true">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">VIP模块</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        <input type="radio" name="isvip" value="1" {{$pls->isvip == 1 ? 'checked' : ''}}> 是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="isvip" value="0" {{$pls->isvip == 0 ? 'checked' : ''}}> 否
                    </label>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        </div>
        <div class="col-sm-4 col-sm-offset-2">
            <a href="javascript:history.back();" class="btn btn-white" >取消</a>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
        {{csrf_field()}}
{{--        {{method_field('put')}}--}}
    </form>
    <script>

        $("#file_upload").change(function(){
            uploadImage();
        });

        function uploadImage() {
            //  判断是否有选择上传文件
            var imgPath = $("#file_upload").val();
            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }
            var formData = new FormData($('#art_form')[0]);
            $.ajax({
                type: "POST",
                url: "/admin/upload/plates",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
//                    本地服务器
//                    $('#img1').attr('src','/'+data);
//                    阿里云OSS
                    $('#img1').attr('src','http://bbs189.oss-cn-beijing.aliyuncs.com/'+data);

                    $('#art_thumb').val('/'+data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }



    </script>
@endsection