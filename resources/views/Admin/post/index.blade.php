<?php /** * Created by PhpStorm. * User: Administrator * Date: 2017/9/27
* Time: 15:44 */ ?>
@extends('Layouts.admin') @section('title','帖子管理') 
@section('content')
    <!-- <div class="ibox float-e-margins"> -->
        <!-- <div class="ibox-content"> -->
            <!-- <div class="container"> -->
    <style>
        .row label{
            color:#1ab394;
            font-size:13px;
        }
        .input-sm{
            font-size:12px;
        }
    </style>
    <div class="row">
        <form action="{{url('admin/post')}}" method="get">
            <div class="col-md-2">
                            <div class="dataTables_length" id="editable_length">
                                <label>
                                    每页显示<br>
                                    <select name="pagea" aria-controls="editable" class="form-control input-sm">
                                        <option value="5"
                                         @if($num==5) 
                                            selected="selected"
                                          @endif>
                                            5
                                        </option>
                                        <option value="10"
                                                @if($num==10)
                                            selected="selected"
                                          @endif>
                                            10
                                        </option>
                                        <option value="15"
                                                @if($num==15)
                                            selected="selected"
                                          @endif>
                                            15
                                        </option>
                                        <option value="20"
                                            @if($num==20)
                                            selected="selected"
                                          @endif>
                                            20
                                        </option>
                                    </select>
                                    
                                </label>
                            </div>
            </div>
            <div class="col-md-2">
                <div class="plates" id="editable_length">
                    <label>板块查询<br>
                        <select class="form-control m-b input-sm" name="pid" id="type">
                            <option value="" >|---顶级分类---|</option>
                            @foreach($pls as $k => $v)

                                <option value="{{$v->id}}" {{ $pid==$v->id ? 'selected':'' }} > {{$v->pname}} </option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                            <div class="plates" id="editable_length">
                                <label>类别查询<br>
                                    <select class="form-control m-b input-sm" name="cid" id="type">
                                         <option value="">|---顶级分类---|</option>
                                            @foreach($cls as $k => $v)

                                            <option value="{{$v->id}}" {{ $cid==$v->id ? 'selected':'' }} > {{$v->cname}} </option>
                                            @endforeach
                                    </select>
                                </label>
                            </div>
            </div>            
            <div class="col-md-2">
                <div id="keywords" class="dataTables_filter ">
                    <label>标题查询:<br>
                        <input type="search" name="title" class="form-control input-sm" placeholder="请输入关键字" aria-controls="editable">
                    </label>
                </div>
            </div>
            <div class="col-md-1">  
                <br>
                    <input type="submit" class="btn btn-primary btn-sm" value="查询">
            </div>
        </form> 
    </div>
    
                    <!-- <div class="row"> -->
                  <!-- <div class="col-sm-11"> -->
    <!-- <div class="row"> -->
        <div class="table-responsive">
                <table id="editable" class="table table-striped table-bordered table-hover  dataTable text-nowrap"
                        role="grid" aria-describedby="editable_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 72px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                        ID
                                    </th>
                                    <th  tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 234px;" aria-label="Browser: activate to sort column ascending">
                                        标题
                                    </th> 
                                    <th    tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 212px;" aria-label="Platform(s): activate to sort column ascending">
                                         发帖人
                                    </th>
                                    <th    tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 212px;" aria-label="Platform(s): activate to sort column ascending">
                                         发帖时间
                                    </th>
                                    <th    tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 146px;" aria-label="Engine version: activate to sort column ascending">
                                        板块类别
                                    </th>
                                    <th    tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 103px;" aria-label="CSS grade: activate to sort column ascending">
                                        分类类别
                                    </th>
                                    <th    tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 103px;" aria-label="CSS grade: activate to sort column ascending">
                                        回复数
                                    </th>
                                    <th    tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 103px;" aria-label="CSS grade: activate to sort column ascending">
                                        状态
                                    </th>
                                    <th    tabindex="0" aria-controls="editable" rowspan="1"
                                    colspan="1" style="width: 103px;" aria-label="CSS grade: activate to sort column ascending">
                                        操作
                                    </th>

                                </tr>
                            </thead>
                            

                        <tbody>
                            @foreach($res as $k => $v)
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">
                                    {{$v->id}}
                                </td>
                                <td class="center">
                                    <a href="/home/post/{{$v->id}}">{{$v->title}}</a>
                                </td>
                                <td class="center">
                                    {{$v->username}}
                                </td>
                                <td class="center">
                                    {{$v->posttime}}
                                </td>                   
                                <td class="center">
                                    {{$v->pname}}
                                </td>                   
                                <td class="center">
                                    {{$v->cname}}
                                </td>                   
                                <td class="center">
                                    {{$v->replaycount}}
                                </td>                   
                                <td class="center">
                                    {{$statu[$v->postcode]}}
                                </td>                   
                                <td class="center">
                                <a href="{{url('admin/post/'.$v->id)}}" class="btn btn-info btn-sm">详情</a>
                                <!-- <a href="javascript:void(0)" onclick="detail({{$v->id}})">详情</a> -->
                            @if($v->status == 0)
                                <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="sta({{$v->id}})">禁用</a>
                            @else 
                                <a href="javascript:void(0);" onclick="stat({{$v->id}})" class="btn btn-success btn-sm">开启</a>
                            @endif

                            @if($v->good == 0)
                                <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="good({{$v->id}})">加　精</a>
                            @else 
                                <a href="javascript:void(0);" onclick="nogood({{$v->id}})" class="btn btn-success btn-sm">不加精</a>
                            @endif
                            @if($v->stick == 0)
                                <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="stick({{$v->id}})">置　顶</a>
                            @else 
                                <a href="javascript:void(0);" onclick="nostick({{$v->id}})" class="btn btn-success btn-sm">不置顶</a>
                            @endif
                                     <a href="javascript:;" onclick="delPost({{$v->id}})" class="btn btn-danger btn-sm">删除</a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
     
                </table>
        </div>
    <!-- </div> -->
    
    <div align="center">
        <!-- <div class="col-sm-6 col-sm-offset-3"> -->
            <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                          
                {!! $res->appends(['title'=>$input,'pagea'=>$num,'pid'=>$pid,'cid'=>$cid])->render() !!}
            </div>
        <!-- </div> -->
    </div>
    <div class="row"></div>

 <script>
        // 加精帖子
        function good(id){
            layer.confirm('确认加精？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/post/good')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }
    // 不加精帖子
        function nogood(id){
            layer.confirm('确认不加精？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/post/nogood')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }
            // 置顶帖子
        function stick(id){
            layer.confirm('确认置顶？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/post/stick')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }

    // 不置顶帖子
        function nostick(id){
            layer.confirm('确认不置顶？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/post/nostick')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }
    // 禁用帖子
        function sta(id){
            layer.confirm('确认禁用？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/post/disables')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }

   // 开启帖子
        function stat(id){
            layer.confirm('确认开启？', {
                            btn: ['确认','取消'] //按钮
                        }, function(){
                            $.post("{{url('admin/post/open')}}"+'/'+id,{'_token':'{{csrf_token()}}'},function(data){
                                if(data.status == 0){
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg(data.msg, {icon: 5});
                                }
                            })
                        });

        }
        //删除帖子
        function delPost(id){

            //询问框
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//                通过ajax 向服务器发送一个删除请求
//                $.post('请求的路径'，携带的数据参数，执行后返回的数据)
//                {'key':'value','key1':'value1'}
                $.post("{{url('admin/post/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                    if(data.status == 0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 5});
                    }

                    // console.log(data);

                })
//

            });
        }

    </script>
<!-- 引入layer 待完成 -->
<script type="text/javascript">
    function detail(id){

    // $('')
        
        // console.log(id);

    //页面层
    layer.open({
    type: 1,
    skin: 'layui-layer-rim',  
    area: ['80%', '90%'],  
    content: '<iframe name="layr" width="100%" height="100%" src="/admin/post/show" frameborder="0"></iframe>'
    });
    // // $.get('admin/post/show',{'id':id},function(){})
    // $.ajax({
    //         url : '/admin/post/show',
    //         type : "post",
    //         data: {id:id},
    //         dataType : "json",
 
    //     });
   
    }
</script>  
    <!-- </div>
</div> -->
@endsection 
