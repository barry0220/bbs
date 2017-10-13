@extends("Layouts.admin")

@section("title","论坛管理 | 板块列表")

@section("content")

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                <div class="row">
                    <form action="/admin/plates" method="get">
                        <div class="col-sm-3">
                            <div id="editable_filter" class="dataTables_filter">
                                <label>
                                    搜索：<input type="search" class="form-control input-sm" name="searchname" style="width:180px;" placeholder="{{$searchname ? $searchname:'输入链接名称'}}">
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-success btn-md">查询</button>
                        </div>

                    </form>

                    <div class="col-sm-4">
                        <a href="{{url('admin/plates/create')}}" class="btn btn-info btn-sm" style="font-size:16px;">添加板块</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="javascript:;" class="btn btn-info btn-sm" id="ishide" style="font-size:16px;">隐藏二级板块</a>
                        <a href="javascript:;" class="btn btn-info btn-sm" id="isshow" style="font-size:16px;">显示二级板块</a>

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
                        <th class="sorting_asc"  style="width: 80px;">板块名称</th>
                        <th class="sorting_asc" style="width: 120px;">板块图像</th>
                        <th class="sorting_asc" style="width: 20px;">VIP板块</th>
                        <th class="sorting_asc"  style="width: 175px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pls as $k => $v)
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1">{{$v->id}}</td>
                        <td>{{$v->pname}}</td>
                        <td><img src="{{asset($v->imgfile)}}" alt="" width="100" height="70"></td>
                        <td class="center">{{$v->isvip == 1 ? '是':'否'}}</td>
                        <td class="center">

                            <a href="/admin/plates/{{$v->id}}/edit" class="btn btn-success btn-sm">修改</a>
                            <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delPlate('{{$v->id}}')">删除</a>
                            <a href="/admin/childadd/{{$v->id}}" class="btn btn-info btn-sm">添加子类</a>
                        </td>
                    </tr>
                        <!--遍历当前板块下面所有的子板块,并显示出来-->
                        @foreach($cpls as $m => $n)
                            @if($n -> pid == $v -> id)
                                <tr class="gradeA odd childplate" role="row" height="70">
                                    <td class="sorting_1">{{$n->id}}</td>
                                    <td>{{$n->cname}}</td>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">
                                        <a href="/admin/childedit/{{$n->id}}" class="btn btn-success btn-sm">修改</a>
                                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="delchildPlate('{{$n->id}}')">删除</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
        <script>
            $('#ishide').hide();
            $('.childplate').hide()
            $('#ishide').click(function(){

                $('.childplate').hide()
                $(this).hide();
                $('#isshow').show();
            });
            $('#isshow').click(function(){

                $('.childplate').show()
                $(this).hide();
                $('#ishide').show();
            });


            function delPlate(id){
                //询问框
                layer.confirm('确认删除这个板块吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
//                通过ajax 向服务器发送一个删除请求
                    $.post("{{url('admin/plates/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){

                        if(data.status == 0){
//                            location.href = location.href;
                            layer.msg("sadfasd", {icon: 6});
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