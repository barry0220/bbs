@extends('Layouts.admin');
@section("title","论坛管理 | 管理员添加")
@section('content')
    <style>
        .form-horizontal{
            margin-top:20px;
        }
    </style>
    {{--<div class="ibox-content">--}}
        <form method="post" class="form-horizontal" action="{{url('admin/user')}}">
            {{csrf_field()}}

            <div class="form-group"><label class="col-sm-2 control-label">用 户 名:</label>

                <div class="col-sm-3"><input type="text" class="form-control" name="username"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">密　　码:</label>
                <div class="col-sm-3"><input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">确认密码:</label>

                <div class="col-sm-3"><input type="password" class="form-control" name="repassword"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">昵　　称:</label>

                <div class="col-sm-3"><input type="text" name="nickname" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">性　　别:</label>
                <div class="col-sm-3">
                    <label><input type="radio" checked="" id="optionsRadios1" name="sex" value="nan">男</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" id="optionsRadios2" name="sex" value="nv">女</label>
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">年　　龄:</label>

                <div class="col-sm-3"><input type="text" name="age" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">手 机 号:</label>

                <div class="col-sm-3"><input type="text" name="phone" class="form-control"></div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-lg-2 control-label">电子邮件:</label>

                <div class="col-lg-3"><input type="email" placeholder="Email" name="email" class="form-control">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="submit">取消</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">添加用户</button>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        </form>
    {{--</div>--}}
@endsection