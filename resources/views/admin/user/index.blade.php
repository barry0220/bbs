@extends("Layouts.admin");
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
                        <a href="{{url('admin/user/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">+</a>
                    </div>
                    <div class="col-sm-4">
                        <div id="editable_filter" class="dataTables_filter">
                            <label>
                                关键词：<input type="search" class="form-control input-sm" placeholder="输入查询条件">
                            </label>
                        </div>
                    </div>
                </div>
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

                            <a href="" class="btn btn-danger btn-sm">删除</a>
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
                    {!! $user->render() !!}
                </div>
            </div>
        </div>

@endsection