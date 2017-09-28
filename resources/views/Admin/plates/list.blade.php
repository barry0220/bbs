@extends("Layouts.admin")

@section("title","论坛管理 | 板块列表")

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
                        <a href="{{url('admin/plates/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">+</a>
                    </div>
                    <div class="col-sm-4">
                        <div id="editable_filter" class="dataTables_filter">
                            <label>
                                搜索：<input type="search" class="form-control input-sm" placeholder="输入板块名称">
                            </label>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover  dataTable"
                       id="editable" role="grid" aria-describedby="editable_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" style="width: 189px;">ID号</th>
                        <th class="sorting_asc"  style="width: 253px;">板块名称</th>
                        <th class="sorting_asc" style="width: 229px;">板块图像</th>
                        <th class="sorting_asc" style="width: 102px;">VIP板块</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pls as $k => $v)
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1">{{$v->id}}</td>
                        <td>{{$v->pname}}</td>
                        <td><img src="{{asset($v->imgfile)}}" alt=""></td>
                        <td class="center">{{$v->isvip}}</td>
                        <td class="center">
                            <a href="">添加子类</a>
                            <a href="/admin/plates/{{$v->id}}/edit">修改</a>
                            <a href="">删除</a>
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
        </div>
    </div>

@endsection