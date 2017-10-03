<?php /** * Created by PhpStorm. * User: Administrator * Date: 2017/9/27
* Time: 15:44 */ ?>
@extends('Layouts.admin') @section('title','帖子管理') 
@section('content')
    <div class="ibox float-e-margins">
    <form action="{{url('admin/post')}}" method="get">

            <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline">
                    <style>
                        .row label{
                            color:#1ab394;
                        }
                    </style>
                    <div class="row">
     
                        <div class="col-sm-2">
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
                        <div class="col-sm-2">
                            <div class="plates" id="editable_length">
                                <label>
                                    板块查询
                                    <select name="editable_length" aria-controls="editable" class="form-control input-sm">
                                        <option value="10">
                                            10
                                        </option>
 
                                    </select>
                                     
                                </label>
                            </div>
                        </div>
                         <div class="col-sm-2">
                            <div class="childplates" id="editable_length">
                                <label>
                                    类别查询
                                    <select name="editable_length" aria-controls="editable" class="form-control input-sm">
                                        <option value="10">
                                            10
                                        </option>
                                         
                                    </select>
                                    
                                </label>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div id="keywords" class="dataTables_filter ">
                                <label>
                                    标题查询:
                                    <input type="search" name="title" class="form-control input-sm" placeholder="请输入关键字" aria-controls="editable">
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-1">  
                            <input type="submit" class="btn btn-primary" value="查询">
                        </div>
                    </div>
</form>

                    <table id="editable" class="table table-striped table-bordered table-hover  dataTable"
                    role="grid" aria-describedby="editable_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 72px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                    ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 234px;" aria-label="Browser: activate to sort column ascending">
                                    标题
                                </th> 
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 212px;" aria-label="Platform(s): activate to sort column ascending">
                                     发帖人
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 212px;" aria-label="Platform(s): activate to sort column ascending">
                                     发帖时间
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 146px;" aria-label="Engine version: activate to sort column ascending">
                                    板块类别
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 103px;" aria-label="CSS grade: activate to sort column ascending">
                                    分类类别
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 103px;" aria-label="CSS grade: activate to sort column ascending">
                                    回复数
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
                                colspan="1" style="width: 103px;" aria-label="CSS grade: activate to sort column ascending">
                                    状态
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="editable" rowspan="1"
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
                            <td>
                                {{$v->title}}
                            </td>
                            <td class="center">
                                {{$v->username}}
                            </td>
                            <td class="center">
                                {{$v->posttime}}
                            </td>                   <td class="center">
                                {{$v->pname}}
                            </td>                   <td class="center">
                                {{$v->cname}}
                            </td>                   <td class="center">
                                {{$v->replaycount}}
                            </td>                   <td class="center">
                                {{$statu[$v->status]}}
                            </td>                   <td class="center">
                            <a href="{{url('admin/post/'.$v->id)}}">详情</a>
                            <!-- <a href="javascript:void(0)" onclick="detail({{$v->id}})">详情</a> -->

                                <a href="{{url('admin/post/'.$v->id)}}/edit">修改</a>
                                <a href="#">删除</a>
                            </td>



                        </tr>
@endforeach
                        
                    </tbody>
 
                </table>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_info" id="editable_info" role="status" aria-live="polite">
                            Showing 1 to 10 of 57 entries
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                          
                {!! $res->appends(['title'=>$input,'pagea'=>$num])->render() !!}
                        </div>
                    </div>
                </div>

                <style>
                #editable_paginate{
                     margin-left: 175px; 
                    }
                div ul.pagination{ margin: 2px 0;
                    white-space: nowrap;
                    }
                </style>
@endsection
<script type="text/javascript">
    function detail(id){

    // $('')
        
        console.log(id);

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
