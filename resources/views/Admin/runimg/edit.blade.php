@extends('Layouts.admin')

@section("title","论坛管理 | 轮播图修改")

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
    <form method="post" id="art_form" action="{{ url('admin/runimg/update/').'/'.$runimg->id  }}" class="form-horizontal" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-sm-2 control-label">模版名称</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="name" value="{{$runimg->name}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">关联帖子</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="postid" value="{{$runimg->postid}}" >
            </div>
            <div id="tagdetail" class="col-sm-4">
                <p style="color:red;">
                    1.输入关联帖子的ID<br/>
                </p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">轮播图像</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="art_thumb" name="imgfile" value="{{$runimg->imgfile}}">
                <p><img id="img1" src="{{$runimg->imgfile}}" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
            </div>
            <div class="col-sm-1">
                <input id="file_upload" type="file" name="file_upload" multiple="true">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group" id="data_1">
            <label class="col-sm-2 control-label">过期时间</label>
            <div class="input-group date col-sm-3">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control datepicker" name="expiretime" value="{{date('m/d/Y',$runimg->expiretime)}}">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="col-sm-4 col-sm-offset-2">
            <a href="javascript:history.back();" class="btn btn-white" >取消</a>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
        {{csrf_field()}}
    </form>
    <script>

//                过期时间时间框
//        $('#data_1 .input-group.date').datepicker({
//            todayBtn: "linked",
//            keyboardNavigation: false,
//            forceParse: false,
//            calendarWeeks: true,
//            autoclose: true
//        });
        //设置时间日期框
        $(document).ready(function(){
            $('.datepicker').datepicker();
        });

        $("#file_upload").change(function(){
            uploadImage();
        });
        $("#tagdetail").hide();

        $('input[name=postid]').focus(function(){
            $("#tagdetail").show();
        });

        $('input[name=postid]').blur(function(){
             $("#tagdetail").hide();
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
                url: "/admin/upload/runimg",
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