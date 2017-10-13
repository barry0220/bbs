@extends('Layouts.admin');
@section("title","论坛管理 | 前台用户详情")
@section('content')
    <style>
        .form-horizontal{
            margin-top:20px;
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
    <a href="/admin/userhome" class="btn btn-sm btn-info">返回</a>
    <div class="ibox-content">
        <form method="post" class="form-horizontal" action="{{url('admin/userhome/'.$user->id)}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            {{--<input type="hidden" name="_method" value="PUT">--}}
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="form-group"><label class="col-sm-5 control-label" >用&nbsp;&nbsp;户&nbsp;&nbsp;名:</label>

                            <div class="col-sm-7"><input type="text" class="form-control" value="{{$user->username}}" name="username"></div>

                        </div>
                        <div class="hr-line-dashed"></div>
                    </div>
                    <div class="row">
                        <div class="form-group"><label class="col-sm-offset-2 col-sm-3 control-label">昵　　称:</label>

                            <div class="col-sm-7"><input type="text" name="nickname" class="form-control"  value="{{$userdetail->name}}"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-sm-3 col-sm-offset-2"><img src="{{$userdetail->profile}}" alt=""></div>
                </div>
            </div>



            {{--<div class="form-group"><label class="col-sm-2 control-label" >用 户 名:</label>--}}

                {{--<div class="col-sm-3"><input type="text" class="form-control" value="{{$user->username}}" name="username"></div>--}}
                {{--<div class="col-sm-3 col-sm-offset-2"><img src="/uploads/201709281539439701.jpg" alt=""></div>--}}
            {{--</div>--}}
            {{--<div class="hr-line-dashed"></div>--}}

            {{--<div class="form-group"><label class="col-sm-2 control-label">昵　　称:</label>--}}

                {{--<div class="col-sm-3"><input type="text" name="nickname" class="form-control"  value="{{$userdetail->name}}"></div>--}}
            {{--</div>--}}
            {{--<div class="hr-line-dashed"></div>--}}






            <div class="form-group"><label class="col-sm-2 control-label">性　　别:</label>
                <div class="col-sm-3">
                    <label><input type="radio" checked="" id="optionsRadios1" name="sex" value="1" {{$userdetail->sex == '1' ? 'checked' : ''}} >男</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" id="optionsRadios2" name="sex" value="0"  {{$userdetail->sex == '0' ? 'checked' : ''}}>女</label>
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-sm-2 control-label">年　　龄:</label>

                <div class="col-sm-3"><input type="text" name="age" class="form-control"  value="{{$userdetail->age}}"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">生　　日:</label>

                <div class="col-sm-3"><input type="text" name="birthday" class="form-control" value="{{$userdetail->birthday}}"></div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-lg-2 control-label">简　　介:</label>

                <div class="col-lg-3">
                    {{--<input type="text" name="detail" class="form-control" value="{{$userdetail->detail}}">--}}
                    <textarea name="detail" class="form-control" cols="30" rows="0" style="resize:none;width:500px;height:100px;">{{$userdetail->detail}}</textarea>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">国　　籍:</label>

                <div class="col-lg-3"><input type="text"  name="country" class="form-control" value="{{$userdetail->country}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">Q　　Q:</label>

                <div class="col-lg-3"><input type="text" name="qq" class="form-control" value="{{$userdetail->qq}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">积　　分:</label>

                <div class="col-lg-3"><input type="text" name="scord" class="form-control" value="{{$userdetail->scord}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            {{--<div class="form-group">--}}
                {{--<div class="col-sm-4 col-sm-offset-2">--}}
                    {{--<button class="btn btn-white" type="submit">取消</button>&nbsp;&nbsp;&nbsp;&nbsp;--}}
                    {{--<button class="btn btn-primary" type="submit">确认修改</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="hr-line-dashed"></div>--}}
        </form>
    </div>
@endsection