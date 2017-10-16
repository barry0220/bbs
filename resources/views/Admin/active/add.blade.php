 

@extends('Layouts.admin') @section('title','活动帖详情') 
@section('content')

    <body>


        <div class="ibox float-e-margins">
  
            <div class="ibox-content">
                <form  class="form-horizontal" method="post" action="{{url('admin/active')}}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                             标　　题:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" value="" name="title"   class="form-control">
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

                                    <option value="{{$v->id}}">{{$v->tagname}}</option>
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
                            <input type="text" name="keywords" value="" class="form-control">
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

                                        <option value="{{$v->id}}" {{ $id==$v->id ? 'selected':'' }} > {{$v->pname}} </option>
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

                                    <option value="{{$v->id}}" {{ $id==$v->id ? 'selected':'' }} > {{$v->cname}} </option>
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
                        <div class="col-sm-8">
                             <!-- 加载编辑器的容器 -->
                            <script id="container" name="content" type="text/plain">
                            
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
                            /*ue.ready(function() {
                                //设置编辑器的内容
                                // ue.setContent('hello');
                                //获取html内容，返回: <p>hello</p>
                                // var html = ue.getContent();
                                //获取纯文本内容，返回: hello
                                var txt = ue.getContentTxt();

                                    $.post('/admin/active/create',{'_token':'{{csrf_token()}}','content':'txt'},function(data){
                                     





                                    });

                            });*/

                    </script>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label" style="margin-left: -10px" >
                       <b>是否加精:</b>
                                <label  style="margin-left: 10px">
                                    加　精
                                     <input type="radio"  name="good"  value="1" 
                                    >
                                </label>
                                <label>
                                    不加精<input name="good" checked="checked" value="0" type="radio" 
                                     >
                                    
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
                            <input type="text" name="goodtime" value="" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 50px" >
                       <b>是否置顶:</b>

                                <label  style="margin-left: 10px">
                                    置顶
                                     <input type="radio" value="1" name="stick">
                                </label>
                                <label>
                                    不置顶<input checked="checked" value="1" type="radio" name="stick">
                                    
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
                            <input type="text" name="sticktime" value=""  class="form-control">
                        </div>
                    </div>



                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 30px" >
                           <b>状　　态:</b>

                                    <label  style="margin-left: 10px">
                                        正常<input type="radio" checked="checked" value="0" name="status">
                                    </label>
                                    <label>
                                        已删除
                                        <input type="radio" name="status" value="1" >
                                   </label>                      
                        </div>
                    </div>
 
                    <div class="hr-line-dashed">
                    </div>
 
                         <div class="form-group">
                        <div class="col-sm-5 control-label" style="margin-left:-150px">
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

                </form>
            </div>
        </div>

@endsection 
