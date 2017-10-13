@extends("Layouts.admin")

@section("title","论坛管理 | 广告管理列表")

@section("content")

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                <div class="row">
                    <form action="/admin/adspace" method="get">
                        <div class="col-sm-3">
                            <div class="dataTables_length" id="editable_length">
                                <input type="text" class="form-control datepicker input-sm" style="width:100px;" name="mindate" value="{{date('m/d/Y',$mindate)}}">
                                &nbsp;&nbsp;到&nbsp;&nbsp;<input type="text" class="form-control datepicker input-sm" style="width:100px;" name="maxdate" value="{{date('m/d/Y',$maxdate)}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>
                                    搜索：<input type="search" class="form-control input-sm" name="searchname" style="width:180px;" placeholder="{{$searchname ? $searchname:'输入广告位置'}}">
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-success btn-md">查询</button>
                        </div>

                    </form>

                    <div class="col-sm-3">
                        <a href="{{url('admin/adspace/create')}}" class="btn btn-info btn-sm" style="font-size:14px;">添加广告</a>
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
                        <th class="sorting_asc"  style="width: 80px;">广告位置</th>
                        <th class="sorting_asc" style="width: 120px;">广告标识</th>
                        <th class="sorting_asc" style="width: 120px;">文字内容</th>
                        <th class="sorting_asc" style="width: 120px;">广告图片</th>
                        <th class="sorting_asc" style="width: 120px;">过期时间</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($adspaces as $k => $v)
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1">{{$v->id}}</td>
                        <td>{{$v->adpost}}</td>
                        <td>{{$v->adtag}}</td>
                        <td>{{$v->adcontent}}</td>
                        <td><img src="{{$v->adimg}}" alt="标签图片" width="100" height="60"></td>
                        <td>{{$v->expiretime < time() ? '已过期' : date('Y-m-d H:i:s',$v->expiretime)}}</td>
                        <td class="center">

                            <a href="/admin/adspace/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>
                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delAd('{{$v->id}}')">删除</a>
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
                            {!! $adspaces->appends(['mindate'=>date('m/d/Y',$mindate),'maxdate'=>date('m/d/Y',$maxdate),'searchname'=>$searchname])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            function delAd(id){
                //询问框
                layer.confirm('确认删除这个广告吗？', {
                    btn: ['确认','取消']
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/adspace/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){

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

            //设置时间日期框
            $(document).ready(function(){
                $('.datepicker').datepicker();
            });

        </script>

@endsection