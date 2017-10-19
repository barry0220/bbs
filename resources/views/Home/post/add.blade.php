<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=gbk">
        <title>
            发表新帖 - 凯迪社区 - 全球华人最具影响力的言论及媒体平台
        </title>
        <meta name="author" content="凯迪网络">
        <meta name="keywords" content="凯迪社区,凯迪网络">
        <meta name="description" content="凯迪社区">
        <meta name="copyright" content="凯迪网络版权所有">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <style type="text/css">
            .p-title {height: 35px; line-height: 35px; text-indent: 10px; color: #fff;
            border-bottom: 1px solid #fff; background: #92c8ca;} .btn-preview, .btn-preview-b
            {width: 23px; height: 23px; margin-top: 7px; margin-right: 6px; cursor:
            pointer; background: url('{{asset('/home/img/icon_post.png')}}')
            -34px -483px no-repeat;} .btn-preview-b {background-position: -4px -483px;}
        </style>
        <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
        <link rel="bookmark" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
        <link href="{{asset('/home/css/base2.css')}}" rel="stylesheet" type="text/css">
        <!--通用样式-->
        <link href="{{asset('/home/css/club-2013718-jian.css')}}" rel="stylesheet"
        type="text/css">

        <link href="{{asset('/home/css/publishpost.css')}}" rel="stylesheet" type="text/css">
        <!-- 发帖页面样式 -->
        <script type="text/javascript" language="javascript" src="{{asset('/home/js/jquery-1.js')}}">
        </script>

        <script type="text/javascript" language="javascript" src="{{asset('/home/js/jquery.js')}}">
        </script>
        <!--jquery.tools-->
        <!--编辑器功能-->
        <link href="{{asset('/home/css/textareajsfile.css')}}" rel="stylesheet"
        type="text/css">
        <script type="text/javascript" language="javascript" src="{{asset('home/js/Pinyin.js/')}}">
        </script>
        <script type="text/javascript" language="javascript" src="{{asset('home/js/sm.js/')}}">
        </script>
        <!-- bootstarp -->
        <script src="{{asset('/admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/admin/js/bootstrap-datepicker.js')}}"></script>
        <link href="{{asset('/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
        <link href="{{asset('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    </head>
    <body class="post-page">
        <div style="width:100%;background:#DCECED;height:100%;">
            <!-- header -->
            <div id="postHeat" class="post-page-h clearfix">
                <div class="p-logo">
                    <div class="p-plank">
                        猫眼看人
                    </div>
                </div>
                <div class="p-msg-r">
                </div>
            </div>
            <form  method="post" action="{{url('home/post')}}"
            target="sfid"  style="width:620px; margin:0 auto;">
                <div style="height: 100%;" id="postPageC" class="post-page-c">
                   
                    <div style="height: 607px; width: 100%;" id="postInputL" class="post-input-l">
                        <div class="userlogin-box clearfix">
                            <div style="width:100%;overflow:hidden;margin-left: 10px">
                                <!-- <div class="t-input-a"> -->
                                    <div class="ti col-sm-2 ">
                                        昵　　称：
                                    </div>
                                    <div class="col-sm-4">
                                    <input name="username" value="" class="input-boder" "
                                    id="username" onkeypress="enter_onkeypress(event)" type="text">
                                    </div>

                            </div>

                        </div>
                        <div class="userlogin-box clearfix">
                            <div style="width:100%;overflow:hidden;margin-left: 10px">
                                <!-- <div class="t-input-a"> -->
                                    <div class="ti col-sm-2 ">
                                        标　　题：
                                    </div>
                                    <div class="col-sm-5">
                                    <input name="title" value="" class="input-boder" "
                                    id="username" onkeypress="enter_onkeypress(event)" type="text">
                                    </div>
                            </div>

                        </div>
                        <div class="userlogin-box clearfix">
                            <div style="width:100%;overflow:hidden;margin-left: 10px">
                                <!-- <div class="t-input-a"> -->
                                    <div class="ti col-sm-2 ">
                                        关 键 字：
                                    </div>
                                    <div class="col-sm-5">
                                    <input name="keywords" value="" class="input-boder" "
                                    id="username" onkeypress="enter_onkeypress(event)" type="text">
                                    </div>
                            </div>

                        </div>
                        <div class="userlogin-box clearfix">
                             <label class="col-sm-2 control-label">
                                 标　　签:
                            </label>
                            <div class="col-sm-4">

                                <select class="form-control m-b " name="tid" id="type">
                                
                                    @foreach($tag as $k => $v)

                                        <option value="{{$v->id}}">{{$v->tagname}}</option>
                                     @endforeach
                                </select>
                            </div>

                        </div>  

                        <div class="userlogin-box clearfix">

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

                        <div class="userlogin-box clearfix">
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

                         <!-- 内容 -->

                       <!-- 百度富文本 -->
                    <div style="width: 600px;"  class="col-sm-8">
                         <!-- 加载编辑器的容器 -->
                        <script id="container"  name="content" type="text/plain">
                        这里写你的初始化内容
                        </script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="{{asset('./ueditor/ueditor.config.js')}}"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="{{asset('./ueditor/ueditor.all.js')}}"></script>
                        <script type="text/javascript" src="{{asset('./ueditor/jquery-1.js')}}"></script>
                         <a id="btn" href="javascript:;">发布</a>
 
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                        // var ue = UE.getEditor('container');
                        
                        var editor = UE.getEditor('container',{    
                            //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个    
                            toolbars:[['FullScreen', 'Source', 'Undo', 'Redo','bold','test','simpleupload','fontfamily','fontsize','bold','italic','justifyleft','justifycenter','horizontal']],    
                            //focus时自动清空初始化时的内容    
                            autoClearinitialContent:true,    
                            //关闭字数统计    
                            // wordCount:false,    
                            //关闭elementPath    
                            elementPathEnabled:false,    
                            //默认的编辑区域高度    
                            initialFrameHeight:300    
                            //更多其他参数，请参考ueditor.config.js中的配置项    
                        });  
                         
                        
                        </script>


                    </div>
    
                </div>
            </div> 
                {{csrf_field()}}

                <div>
                    <input type="submit" value="发布" style="margin-left: 530px" />
                </div>
               
            </form>

            <!-- center content end-->
            <!-- footer -->
            <div id="postFooter" class="post-page-f">
                <!--声明-->
                <div class="site-statement">
                    <div style="width:800px; margin:0 auto;">
                        <span class="c-alarm">
                            本站声明：
                        </span>
                        本站BBS互动区上的文章系由网友自行帖上，文责自负，版权归网站与作者共同所有，网站方维护作者合法权益。
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        任何网络媒体或传统媒体如需刊用转帖转载，必须注明来源及其原创作者。特此声明！
                        <br>
                        <span class="c-alarm">
                            【管理员特别提醒】
                        </span>
                        发布信息时请注意首先阅读 ( 琼B2-20060022 )：
                        <br>
                        1.全国人大常委会关于维护互联网安全的决定；2.凯迪网络BBS互动区用户注册及管理条例。谢谢！
                    </div>
                </div>
                <!--声明 End-->
                <!--尾部-->
                <div class="footer-club">
                    Copyright &#169; 2000~2010
                    <span class="c-main">
                        <a href="http://www.kdnet.net/">
                            kdnet.net
                        </a>
                    </span>
                    corporation. All Rights Reserved
                    <br>
                    <span class="c-sub">
                        <a href="#">
                            关于凯迪
                        </a>
                        |
                        <a href="#">
                            合作联系
                        </a>
                        |
                        <a href="#">
                            广告服务
                        </a>
                        |
                        <a href="#">
                            法律声明
                        </a>
                        |
                        <a href="#">
                            加入凯迪
                        </a>
                        |
                        <a href="#">
                            网站地图
                        </a>
                    </span>
                </div>
                <!--尾部 End-->
            </div>
            <!-- footer end -->
        </div>

    </body>


</html>