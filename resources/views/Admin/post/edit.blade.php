 

@extends('Layouts.admin') @section('title','修改帖子') 
@section('content')

    <body>
        <a href="/admin/post">返回</a>
        <div class="ibox float-e-margins">
  
            <div class="ibox-content">
                <form  class="form-horizontal" action="{{url('admin/post/'.$res[0]->id)}}" method="post" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             标　　题:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="title" value="{{$res[0]->title}}"     class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             发帖人　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="uid" value="{{$res[0]->uid}}"   class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             发帖时间:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->posttime}}" name="posttime"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             标　　签:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->tagid}}" name="tagid"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             关键字　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text"  value="{{$res[0]->keywords}}" name="keywords"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             板块类别:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->pid}}" name="pid"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             分类类别:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->cid}}" name="cid"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             内　　容:
                        </label>
                        <div class="col-sm-4">
                           <textarea   name="content" id="" cols="30" rows="10">{{$res[0]->content}}</textarea>    
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             回复数　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->replaycount}}" name="replaycount"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             点击量　:
                        </label>　
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->clickcount}}" name="clickcount"  class="form-control">
                        </div>
                    </div>

                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 50px" >
                       <b>是否加精:</b>

                                <label  style="margin-left: 10px">
                                    加　精
                                     <input type="radio" name="good" value="0" 
                                    @if($res[0]->good == 0)
                                        checked="checked"
                                    @endif
                                      id="optionsRadios1" >

                                </label>
                                <label>
                                    不加精<input type="radio" 
                                     @if($res[0]->good == 1)
                                        checked="checked"
                                    @endif
                                    name="good" id="optionsRadios2"
                                      value="1" >
                                    
                               </label>                      
                        </div>
                    </div>


                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             加精时间:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="goodtime"   value="{{$res[0]->goodtime}}" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 50px" >
                       <b>是否置顶:</b>

                                <label  style="margin-left: 10px">
                                    置顶
                                     <input type="radio" name="stick" value="0" 
                                    @if($res[0]->stick == 0)
                                        checked="checked"
                                    @endif
                                      id="optionsRadios1" >

                                </label>
                                <label>
                                    不置顶<input type="radio" 
                                     @if($res[0]->stick == 1)
                                        checked="checked"
                                    @endif
                                    name="stick" id="optionsRadios2"
                                      value="1" >
                                    
                               </label>                      
                        </div>
                    </div>


                    <div class="hr-line-dashed">
                    </div>
 


                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             置顶时间:
                        </label>
                        <div class="col-sm-4">
                            <input type="text"  value="{{$res[0]->sticktime}}"  name="sticktime"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             点赞数量:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->admire}}"  name="admire"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             点踩数量:
                        </label>
                        <div class="col-sm-4">
                            <input type="text"  value="{{$res[0]->tread}}" name="tread"   class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                          <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 30px" >
                       <b>状　　态:</b>

                                <label  style="margin-left: 10px">
                                    正常
                                     <input type="radio" name="status"  value="0" 
                                    @if($res[0]->status == 0)
                                        checked="checked"
                                    @endif
                                      id="optionsRadios1" >

                                </label>
                                <label>
                                    已删除<input type="radio" 
                                     @if($res[0]->status == 1)
                                        checked="checked"
                                    @endif
                                    name="status" id="optionsRadios2"
                                      value="1" >
                                    
                               </label>                      
                        </div>
                    </div>

                    <div class="hr-line-dashed">
                    </div>
                         <div class="form-group">
                        <div class="col-sm-4 control-label" style="margin-left: 20px" >
                       <b>帖子类型:</b>

                                <label  style="margin-left: 10px">
                                    普通帖
                                     <input type="radio" name="postcode" value="0" 
                                    @if($res[0]->postcode == 0)
                                        checked="checked"
                                    @endif
                                      id="optionsRadios1" >

                                </label>
                                <label>
                                    活动贴<input type="radio" 
                                     @if($res[0]->postcode == 1)
                                        checked="checked"
                                    @endif
                                    name="postcode" id="optionsRadios2"
                                      value="1" >
                                    
                               </label> 
                                <label>
                                    公告帖<input type="radio" 
                                     @if($res[0]->status == 2)
                                        checked="checked"
                                    @endif
                                    name="status" id="optionsRadios2"
                                      value="2" >
                                    
                               </label>                      
                        </div>
                    </div>

            <div><input type="submit" class="btn btn-primary" style="margin-left: 800px" value="提交"></div>
                    <div class="hr-line-dashed">
                    </div>
        {{csrf_field()}} 
     {{ method_field('PUT') }}
                </form>
            </div>
        </div>

@endsection 
