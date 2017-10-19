 

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

                            <select class="form-control m-b " name="tid" id="type">
                            
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
                                        <option value="0" {{ $id=='0' ? 'selected':'' }} >|---顶级板块---|</option>
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
                        <!-- <div id="dvs"></div> -->
                        <div class="col-sm-8">
                             <!-- 加载编辑器的容器 -->
                            <script id="container" name="content" type="text/plain">
                            <!-- 这里写你的初始化内容 -->
                             </script>
                            <!-- 配置文件 -->
                            <script type="text/javascript" src="{{asset('./ueditor/ueditor.config.js')}} "></script>
                            <!-- 编辑器源码文件 -->
                            <script type="text/javascript" src="{{asset('./ueditor/ueditor.all.js')}}"></script>
                      
                        </div>
                    </div>

                          <script>
                                                   
                        var ue = UE.getEditor('container',{    
                            //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个    
                            toolbars:[['FullScreen', 'Source', 'Undo', 'Redo','bold','test','simpleupload','fontfamily','fontsize','bold','italic','justifyleft','justifycenter','horizontal']],    
                            //focus时自动清空初始化时的内容    
                            // autoClearinitialContent:true,    
                            //关闭字数统计    
                            // wordCount:false,    
                            //关闭elementPath    
                            elementPathEnabled:false,    
                            //默认的编辑区域高度    
                            initialFrameHeight:300    
                            //更多其他参数，请参考ueditor.config.js中的配置项    
                        });  
                          </script>
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label" style="margin-left: -10px" >
                       <b>是否加精:</b>
                                <label  style="margin-left: 10px">
                                    加　精
                                     <input type="radio" id="good"  name="good"  value="1" 
                                    >
                                </label>
                                <label>
                                    不加精<input name="good" checked="checked" value="0" type="radio" 
                                     >
                                    
                               </label>                      
                        </div>
                    </div>
                <!--     <div class="hr-line-dashed">
                    </div> -->
<!--                     <div class="form-group">
                        <label class="col-sm-2 control-label">
                             加精时间:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" id="goodtime" name="goodtime" value="" class="form-control"  readonly="readonly" >
                        </div>
                    </div> -->
                    <div class="hr-line-dashed">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 control-label" style="margin-left: 50px" >
                       <b>是否置顶:</b>

                                <label  style="margin-left: 10px">
                                    置顶
                                     <input type="radio" id="stick" value="1" name="stick">
                                </label>
                                <label>
                                    不置顶<input checked="checked" value="0" type="radio" name="stick">
                                    
                               </label>                      
                        </div>
                    </div>
                <!--     <div class="hr-line-dashed">
                    </div> -->
   <!--                  <div class="form-group">
                        <label class="col-sm-2 control-label">
                             置顶时间:
                        </label>
                        <div class="col-sm-4">
                            <input type="text" id="sticktime" name="sticktime" value=""  class="form-control" readonly="readonly">
                        </div>
                    </div> -->



                    <div class="hr-line-dashed">
                    </div>
                      <script>
                        $('#good').click(function(){
                            // var date = new Date();

                            // alert();

                       var timeStr = '';
                          var curDate = new Date();
                          var curYear = curDate.getFullYear();
                          var curMonth = curDate.getMonth()+1;  //获取当前月份(0-11,0代表1月)
                          var curDay = curDate.getDate();       //获取当前日(1-31)
                          var curWeekDay = curDate.getDay();    //获取当前星期X(0-6,0代表星期天)
                          var curHour = curDate.getHours();      //获取当前小时数(0-23)
                         var curMinute = curDate.getMinutes();   // 获取当前分钟数(0-59)
                         var curSec =curDate.getSeconds();      //获取当前秒数(0-59)
                         timeStr = curYear+'年'+curMonth+'月'+curDay+'日 周';
                         switch(curWeekDay)
                         {
                           case 0:timeStr += '日';break;
                           case 1:timeStr += '一';break;
                           case 2:timeStr += '二';break;
                           case 3:timeStr += '三';break;
                           case 4:timeStr += '四';break;
                           case 5:timeStr += '五';break;
                           case 6:timeStr += '六';break;
                         }
                         if(curHour < 10)
                         {
                           if(curMinute < 10)
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' 0'+curHour+':0'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' 0'+curHour+':0'+curMinute+':'+curSec;
                             }
                           }
                           else
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' 0'+curHour+':'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' 0'+curHour+':'+curMinute+':'+curSec;
                             }
                           }
                         }
                         else
                         {
                           if(curMinute < 10)
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' '+curHour+':0'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' '+curHour+':0'+curMinute+':'+curSec;
                             }
                           }
                           else
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' '+curHour+':'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' '+curHour+':'+curMinute+':'+curSec;
                             }
                           }
                         }
                    $('#goodtime').val(timeStr);
                    

         })     
                   $('#stick').click(function(){
                            // var date = new Date();

                            // alert();

                       var timeStr = '';
                          var curDate = new Date();
                          var curYear = curDate.getFullYear();
                          var curMonth = curDate.getMonth()+1;  //获取当前月份(0-11,0代表1月)
                          var curDay = curDate.getDate();       //获取当前日(1-31)
                          var curWeekDay = curDate.getDay();    //获取当前星期X(0-6,0代表星期天)
                          var curHour = curDate.getHours();      //获取当前小时数(0-23)
                         var curMinute = curDate.getMinutes();   // 获取当前分钟数(0-59)
                         var curSec =curDate.getSeconds();      //获取当前秒数(0-59)
                         timeStr = curYear+'年'+curMonth+'月'+curDay+'日 周';
                         switch(curWeekDay)
                         {
                           case 0:timeStr += '日';break;
                           case 1:timeStr += '一';break;
                           case 2:timeStr += '二';break;
                           case 3:timeStr += '三';break;
                           case 4:timeStr += '四';break;
                           case 5:timeStr += '五';break;
                           case 6:timeStr += '六';break;
                         }
                         if(curHour < 10)
                         {
                           if(curMinute < 10)
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' 0'+curHour+':0'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' 0'+curHour+':0'+curMinute+':'+curSec;
                             }
                           }
                           else
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' 0'+curHour+':'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' 0'+curHour+':'+curMinute+':'+curSec;
                             }
                           }
                         }
                         else
                         {
                           if(curMinute < 10)
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' '+curHour+':0'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' '+curHour+':0'+curMinute+':'+curSec;
                             }
                           }
                           else
                           {
                             if(curSec < 10)
                             {
                               timeStr += ' '+curHour+':'+curMinute+':0'+curSec;
                             }
                             else
                             {
                               timeStr += ' '+curHour+':'+curMinute+':'+curSec;
                             }
                           }
                         }
                    
                    $('#sticktime').val(timeStr);

         })





                        
                    </script>
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
                                    活动贴<input type="radio" checked="checked" value="1" name="postcode">
                               </label>
                                <label>
                                    公告帖<input type="radio"  value="2" name="postcode">
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
