@extends('Layouts.admin')

@section("title","论坛管理 | 友情链接添加")

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
    <form method="post" id="art_form" action="{{ url('admin/warwork') .'/'.$warwork->id }}" class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">敏感词</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="works" value="{{$warwork->works}}" >
            </div>
        </div>
 
        <div class="hr-line-dashed"></div>
        <div class="col-sm-4 col-sm-offset-2">
            <a href="javascript:history.back();" class="btn btn-white" >取消</a>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
        {{csrf_field()}}
        {{method_field('put')}}
    </form>
@endsection