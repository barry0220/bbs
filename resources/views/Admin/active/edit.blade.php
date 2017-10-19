 

@extends('Layouts.admin') @section('title','修改活动贴') 
@section('content')

    <body>


        <div class="ibox float-e-margins">
  
            <div class="ibox-content">
                <form  class="form-horizontal" method="post" action="{{url('admin/active/'.$res[0]->id)}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             标　　题:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$res[0]->title}}" name="title"   class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
<!--                     <div class="form-group">
                        <label class="col-sm-2 control-label">
                             发帖人　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="username" value=""  class="form-control">
                        </div>
                    </div> -->
                 <!--    <div class="hr-line-dashed">
                    </div> -->
         <!--            <div class="form-group">
                        <label class="col-sm-2 control-label">
                             发帖时间:
                        </label>
                        <div class="col-sm-4">
                            <input type="text"  name="posttime" value=""  class="form-control">
                        </div>
                    </div> -->
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             标　　签:
                        </label>
                        <div class="col-sm-4">
                            <!-- <input type="text" value="" name="tname" class="form-control"> -->

                            <select class="form-control m-b " name="pid" id="type">
                            
                                @foreach($tag as $k => $v)

                                    <option value="{{$v->id}}" {{  $res[0]->tagid == $v->id ? 'selected':'' }} >{{$v->tagname}}</option>
                                 @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             关键字　:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="keywords" value="{{$res[0]->keywords}}" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             板块类别:
                        </label>
                        
                            <div class="col-sm-4 plates " id="editable_length">
                                 <select class="form-control m-b " name="pid" id="type">
                                        <option value="0" {{ $id=='0' ? 'selected':'' }} >|---顶级分类---|</option>
                                            @foreach($pls as $k => $v)

                                        <option value="{{$v->id}}" {{ $res[0]->pid ==$v->id ? 'selected':'' }} > {{$v->pname}} </option>
                                            @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             分类类别:
                        </label>
                        <div class="col-sm-4">
                             <select class="form-control m-b " name="cid" id="type">
                                    <option value="0" {{ $id=='0' ? 'selected':'' }} >|---顶级分类---|</option>
                                    @foreach($cls as $k => $v)

                                    <option value="{{$v->id}}" {{ $res[0]->cid==$v->id ? 'selected':'' }} > {{$v->cname}} </option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             内　　容:
                        </label>
                        <!-- <div id="dvs"></div> -->
                        <div class="col-sm-8">
                             <!-- 加载编辑器的容器 -->
                            <script id="container" name="content" type="text/plain">
                            <!-- 这里写你的初始化内容 -->
                            {!!$res[0]->content!!}
                            </script>
                            <!-- 配置文件 -->
                            <script type="text/javascript" src="{{asset('./ueditor/ueditor.config.js')}} "></script>
                            <!-- 编辑器源码文件 -->
                            <script type="text/javascript" src="{{asset('./ueditor/ueditor.all.js')}}"></script>
                      
                        </div>
                    </div>

                            <!-- 实例化编辑器 -->
                    <script>
                            var ue = UE.getEditor('container');
                            //对编辑器的操作最好在编辑器ready之后再做
                            // ue.ready(function() {
                            //     //设置编辑器的内容
                            //     // ue.setContent('{{$res[0]->content}}');
                            //     //获取html内容，返回: <p>hello</p>
                            //     // var html = ue.getContent();
                            //     //获取纯文本内容，返回: hello
                            //     var txt = ue.getContentTxt();
                            //     var txts = htmlspecialchars(txt);
                            //         $.post('/admin/active/create',{'_token':'{{csrf_token()}}','content':'txts'},function(data){
                                                                   
                            //         });

                            // });

                    </script>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 50px" >
                       <b>是否加精:</b>

                                <label  style="margin-left: 10px">
                                    加　精
                                     <input type="radio" name="good" 
                                    @if($res[0]->good == 1)
                                        checked="checked"
                                    @endif
                                      id="optionsRadios1" >

                                </label>
                                <label>
                                    不加精<input type="radio" 
                                     @if($res[0]->good == 0)
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
                            <input type="text" readonly="readonly" name="goodtime" value="{{date('Y-m-d H:i:s',$res[0]->goodtime)}}" class="form-control">
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
                                    @if($res[0]->stick == 1)
                                        checked="checked"
                                    @endif
                                      id="optionsRadios1" >

                                </label>
                                <label>
                                    不置顶<input type="radio" 
                                     @if($res[0]->stick == 0)
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
                            <input type="text" readonly="readonly" name="sticktime" value="{{date('Y-m-d H:i:s',$res[0]->sticktime)}}"  class="form-control">
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
                        <div class="col-sm-2 control-label" style="margin-left: 55px">
                       <b>帖子类型:</b> 
                                <label>
                                    公告帖<input type="radio" checked="checked" value="2" name="postcode">
                               </label>                      
                        </div>
                    </div>

                    <div class="hr-line-dashed">
                    </div>
                 <div class="col-sm-4 col-sm-offset-2">
                     <a href="javascript:history.back();" class="btn btn-white" >取消</a>
                     <button class="btn btn-primary" type="submit">保存</button>
                 </div>
                         {{csrf_field()}}
                         {{method_field('PUT')}}

                </form>
            </div>
        </div>

@endsection 
 


