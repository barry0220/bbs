 

@extends('Layouts.admin') @section('title','帖子详情') 
@section('content')

    <body>
        <a href="/admin/post">
            <input type="submit" class="btn btn-primary btn-sm" value="返回">
            
        </a>

        <div class="ibox float-e-margins">
  
            <div class="ibox-content">
                <form  class="form-horizontal" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             标　　题:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->title}}"  disabled="disabled"  class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             发帖人　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->username}}" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             发帖时间:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->posttime}}" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             标　　签:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->tagid}}" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             关键字　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text"  value="{{$res[0]->keywords}}" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             板块类别:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->pid}}" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             分类类别:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->cid}}" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             内　　容:
                        </label>
                        <div class="col-sm-4">
                           <textarea disabled="disabled" name="content" id="" cols="30" rows="10">{{$res[0]->content}}</textarea>    
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             回复数　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->replaycount}}" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             点击量　:
                        </label>　
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->clickcount}}" disabled="disabled" class="form-control">
                        </div>
                    </div>

                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 50px" >
                       <b>是否加精:</b>

                                <label  style="margin-left: 10px">
                                    加　精
                                     <input type="radio" name="good" 
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
                            <input type="text"  disabled="disabled" value="{{$res[0]->goodtime}}" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 50px" >
                       <b>是否置顶:</b>

                                <label  style="margin-left: 10px">
                                    置顶
                                     <input type="radio" name="stick" 
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
                            <input type="text"  value="{{$res[0]->sticktime}}"  disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             点赞数量:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->admire}}"  disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             点踩数量:
                        </label>
                        <div class="col-sm-4">
                            <input type="text"  value="{{$res[0]->tread}}"  disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                          <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 30px" >
                       <b>状　　态:</b>

                                <label  style="margin-left: 10px">
                                    正常
                                     <input type="radio" name="status" 
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
                                     <input type="radio" name="postcode" 
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
                                     @if($res[0]->postcode == 2)
                                        checked="checked"
                                    @endif
                                    name="status" id="optionsRadios2"
                                      value="2" >
                                    
                               </label>                      
                        </div>
                    </div>

                    <div class="hr-line-dashed">
                    </div>
         

                </form>
            </div>
        </div>

@endsection 
