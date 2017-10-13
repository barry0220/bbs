@extends('Layouts.admin');
@section("title","论坛管理 | 管理员修改")
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
    <div class="ibox-content">
        <form method="post" class="form-horizontal" action="{{url('admin/userhome/'.$user->id)}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            {{--<input type="hidden" name="_method" value="PUT">--}}
            <div class="form-group"><label class="col-sm-2 control-label" >用 户 名:</label>

                <div class="col-sm-3"><input type="text" class="form-control" value="{{$user->username}}" name="username"></div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">手 机 号:</label>

                <div class="col-sm-3"><input type="text" name="phone" class="form-control" value="{{$user->phone}}"></div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group"><label class="col-lg-2 control-label">电子邮件:</label>

                <div class="col-lg-3"><input type="email" placeholder="Email" name="email" class="form-control" value="{{$user->email}}">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="submit">取消</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">确认修改</button>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        </form>
    </div>
@endsection