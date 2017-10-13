@extends("Layouts.admin");
@section("content")

    </style>
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">

                {{--<div class="row">--}}
                    {{--<div class="col-sm-2">--}}
                        {{--<div class="dataTables_length" id="editable_length">--}}
                            {{--<label>--}}
                                {{--<select name="editable_length" aria-controls="editable" class="form-control input-sm">--}}
                                    {{--<option value="10">10</option>--}}
                                    {{--<option value="25">25</option>--}}
                                    {{--<option value="50">50</option>--}}
                                    {{--<option value="100">100</option>--}}
                                {{--</select>--}}
                                {{--每页记录--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-4">--}}
                        {{--<a href="{{url('admin/user/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">+</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-4">--}}
                        {{--<div id="editable_filter" class="dataTables_filter">--}}
                            {{--<label>--}}
                                {{--关键词：<input type="search" name="keywords" class="form-control input-sm" placeholder="输入查询条件">--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <form action="{{url('/admin/user')}}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dataTables_length" id="editable_length">
                                <label>
                                    每页显示
                                    <select name="pagea" aria-controls="editable" class="form-control input-sm">
                                        <option value="5"
                                                @if($num==5)
                                                selected="selected"
                                                @endif>
                                            5
                                        </option>
                                        <option value="10"    @if($num==10)
                                        selected="selected"
                                                @endif>
                                            10
                                        </option>
                                        <option value="15"@if($num==15)
                                        selected="selected"
                                                @endif>
                                            15
                                        </option>
                                        <option value="20"@if($num==20)
                                        selected="selected"
                                                @endif>
                                            20
                                        </option>
                                    </select>

                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{url('admin/user/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">+</a>
                        </div>
                        <div class="col-sm-4">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>
                                    搜索：<input type="search" class="form-control input-sm" name="user" value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}" placeholder="输入用户名">
                                </label>

                                <!-- <input type="submit" value="提交"> -->
                                <!-- <div class="col-md-">   -->
                                <input type="submit" class="btn btn-primary btn-sm" value="查询">

                                <!-- </div> -->



                            </div>
                        </div>
                    </div>


                </form>



                <table class="table table-striped table-bordered table-hover  dataTable"
                       id="editable" role="grid" aria-describedby="editable_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" style="width: 189px;">ID号</th>
                        <th class="sorting_asc"  style="width: 253px;">用户名</th>
                        <th class="sorting_asc" style="width: 229px;">性别</th>
                        <th class="sorting_asc" style="width: 102px;">年龄</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                @foreach($user as $k=>$v)
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1">{{$v->id}}</td>
                        <td>{{$v->username}}</td>
                        <td>{{$sex[$v->sex]}}</td>
                        <td class="center">{{$v->age}}</td>
                        <td class="center">
                            <a href="/admin/user/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>

                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="deladmin('{{$v->id}}')">删除</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
                {{--<div class="row">--}}
                {{--<div class="col-sm-4">--}}

                {{--</div>--}}
                {{--<div class="col-sm-6">--}}
                {{--<div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">--}}
                {{--{{$}}--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div>
                    {!! $user->appends(['username'=>$input,'pagea'=>$num])->render()!!}
                </div>
            </div>
        </div>
        <script>
            function deladmin(id){
                //询问框
                layer.confirm('确认删除这个用户吗？', {
                    btn: ['确认','取消']
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/user/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){

                        if(data.status == 0){
//                            location.href = location.href;
                            layer.msg(data.msg, {icon: 6});
                            setTimeout(function(){
                                location.href = location.href;
                            },3000)
                        }else{

                            layer.msg(data.msg, {icon: 5});
                        }

                    })

                });
            }
        </script>
@endsection