@extends("Layouts.admin")

@section("title","论坛管理 | 友情链接列表")

@section("content")

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="dataTables_length" id="editable_length">
                            <label>
                                <select name="editable_length" aria-controls="editable" class="form-control input-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                每页记录
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{url('admin/links/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">添加链接</a>

                    </div>
                    <div class="col-sm-4">
                        <div id="editable_filter" class="dataTables_filter">
                            <label>
                                搜索：<input type="search" class="form-control input-sm" placeholder="输入板块名称">
                            </label>
                        </div>
                    </div>
                </div>
                <style>
                   #editable  tr > td {
                        vertical-align: middle;
                    }
                </style>
                <table class="table table-striped table-bordered table-hover  dataTable"
                       id="editable" role="grid" aria-describedby="editable_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" style="width: 20px;">ID号</th>
                        <th class="sorting_asc"  style="width: 80px;">链接名称</th>
                        <th class="sorting_asc" style="width: 120px;">链接地址</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $k => $v)
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1">{{$v->id}}</td>
                        <td>{{$v->linkname}}</td>
                        <td><a href="{{$v->link}}" target="_blank">{{$v->link}}</a></td>
                        <td class="center">

                            <a href="/admin/links/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>
                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delLink('{{$v->id}}')">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                            {!! $links->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            function delLink(id){
                //询问框
                layer.confirm('确认删除这个链接吗？', {
                    btn: ['确认','取消']
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/links/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){

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

            function delchildPlate(id){
                //询问框
                layer.confirm('确认删除？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/childdel/')}}/"+id,{'_token':"{{csrf_token()}}"},function(data){

                        if(data.status == 0){
//                            location.href = location.href;
                            layer.msg(data.msg, {icon: 6});
                            setTimeout(function(){
                                location.href = location.href;
                            },3000)
                        }else{
//                            location.href = location.href;
                            layer.msg(data.msg, {icon: 5});
                        }

                    })

                });
            }

        </script>

@endsection