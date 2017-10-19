<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>个人信息设置</title>
    <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link rel="bookmark" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link href="{{asset('/home/css/base4_22.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/face.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/user.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/user2-0923.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{asset('home/js/jquery-2.1.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/jquery.jm.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('home/js/jquery.tools.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('/home/js/valid.js')}}"></script>
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('/home/js/kd.user.js')}}"></script>--}}
    <script>
        {{--function isEmail() {--}}
            {{--var email=$('#email').val();--}}
            {{--if (email.search(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})/) != -1){--}}
                {{----}}
                {{--return true;--}}
            {{--}--}}
            {{--else{--}}
                {{--alert("邮箱格式错误");--}}
                {{--return false;--}}
            {{--}--}}
        {{--}--}}
        $(function(){
            @if($type == 'details')
                userdetails();
            @elseif($type== 'email')
                usercheckemail();
            @endif

        })
        //标签切换
        function userdetails(){
            $('#details').show();
            $('#repass').hide();
            $('#email').hide();
            $('#face').hide();

            $('#userdetails').attr('class','current');
            $('#userrepass').attr('class','false');
            $('#usercheckemail').attr('class','false');
            $('#userface').attr('class','false');
        }

        function userrepass(){
            $('#details').hide();
            $('#repass').show();
            $('#email').hide();
            $('#face').hide();

            $('#userdetails').attr('class','false');
            $('#userrepass').attr('class','current');
            $('#usercheckemail').attr('class','false');
            $('#userface').attr('class','false');
        }

        function usercheckemail(){
            $('#details').hide();
            $('#repass').hide();
            $('#email').show();
            $('#face').hide();

            $('#userdetails').attr('class','false');
            $('#userrepass').attr('class','false');
            $('#usercheckemail').attr('class','current');
            $('#userface').attr('class','false');
        }

        function userface(){
            $('#details').hide();
            $('#repass').hide();
            $('#email').hide();
            $('#face').show();

            $('#userdetails').attr('class','false');
            $('#userrepass').attr('class','false');
            $('#usercheckemail').attr('class','false');
            $('#userface').attr('class','current');
        }

        //用户头像上传
//        $("#file_upload").change(function(){
////            uploadImage();
//            alert(11111);
//        });
        function uploadImage() {
            //  判断是否有选择上传文件
            var imgPath = $("#file_upload").val();
            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }
            var formData = new FormData($('#userfaceform')[0]);
            //formData.append('_token','{{csrf_token()}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "/admin/upload/userface",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
//                    本地服务器
//                    $('#img1').attr('src','/'+data);
//                    阿里云OSS
                    $('#img1').attr('src', 'http://bbs189.oss-cn-beijing.aliyuncs.com/' + data);

                    $('#art_thumb').text('/' + data);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }

        function loginOut(){
            //询问框
            layer.confirm('确认退出登录吗？', {
                btn: ['确认','取消']
            }, function(){
                //                通过ajax 向服务器发送一个删除请求
                $.post("{{url('/home/loginout')}}",{"_token":"{{csrf_token()}}"},function(data){

                    if(data.status == 0){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function(){
                            location.href = "{{url('/home/login')}}";
                        },3000)
                    }else{

                        layer.msg(data.msg, {icon: 5});
                    }

                })

            });
        }

    </script>
</head>

<body class="setting">
<div id="WzTtDiV" style="visibility: hidden; position: absolute; overflow: hidden; padding: 0px; width: 0px; left: 0px; top: 0px;">
</div>
<div id="update_flag" style="display:none">
    0
</div>
<script type="text/javascript" src="{{asset('/home/js/wz_tooltip.js')}}">
</script>
<!--Tips-->
<div id="hidden_frame" style="display:none;"></div>
<!--定位消息-->
<div class="fixed-outer">
    <div class="fixed-inner" id="ajax_header_msg">
        <div class="msg-box clearfix" style="display:none; " id="ajax_header">
        </div>
    </div>
</div>
<!--定位消息 End-->
<div class="clubforum-box" id="overlay">
    <div class="close">
    </div>
    <div class="contentWrap">
    </div>
</div>
<!--头部-->
<div class="header" id="Small">
    <div class="gn-box">
        <div class="gn-body clearfix">
            <div class="logo" title="谜之论坛 谜一般的气质">
                <a href="{{url('/')}}">
                    谜之论坛 谜一般的气质
                </a>
            </div>
            <div class="rf">
                <div class="globalnav c-sub">
                    社区版块：
                    @foreach($plates as $k => $v)
                        <a target="_blank" href="{{url('/home/list/'.$v->id)}}">{{$v->pname}}</a>|
                    @endforeach
                </div>
                <div id="user_index_s_1" class="banner">
                </div>
            </div>
        </div>
    </div>
</div>
<!--头部 End-->
<!--注册人数、日期、注册/登录链接-->
<div id="SmallLoginBox">
    <div class="login-box clearfix">

        <div class="login-info">
            欢迎你&nbsp;
            <span class="c-main">
                <a href="{{url('/home/userinfo')}}">{{session('homeuser')->username}}</a>
            </span>
            <span class="fB c-main">
                <a href="javascript:;" onclick="loginOut()" title="退出">退出</a>
            </span>
        </div>
        {{--<div class="globalsearch">--}}
            {{--<div class="search-text">搜索：</div>--}}
            {{--<input name="q" type="text" id="s"  value="">--}}
            {{--<input type="submit" name="sa" id="searchsubmit" value="搜索" >--}}
        {{--</div>--}}
    </div>
</div>
<!--注册人数、日期、注册/登录链接 End-->
<meta property="qc:admins" content="150330614526346546654">
<!--内容-->
<div id="content">
    <div class="n_gb_t">
    </div>
    <div class="n_gb_c clearfix">
        <div class="lf">
            <!--个人信息-->
            <!--用户头像-->
            <div class="userinfo clearfix">
                <div class="userpic">
                    <div class="modify-userpic">
                        <a href="javascript:;" onclick="userface()">修改头像</a>
                    </div>
                        <span></span>
                        <img id="userface_img_index" onerror="this.src = duf_190_190;" src="{{$details->profile}}"
                             width="70" height="70">
                    </a>
                </div>
                <div class="useridinfo">
                    <div class="userid clearfix">
                        <a href="javascript:;">{{session('homeuser')->username}}</a>
                        <!--身份认证-->
                        <!--手机认证-->
                        <a href="javascript:;">
                            <img class="phone-icon" title="手机绑定用户" src="{{asset('/home/img/transparent.gif')}}">
                        </a>
                    </div>
                    <div class="c-main">
                        <a href="javascript:;">------------------</a>
                    </div>
                    <!-- 开通会员 -->
                    <div class="c-alarm fB mem-open-go">
                        <a href="javascript:;" target="_blank">
                            <img class="member-icon-gray" title="未开通会员" src="{{asset('/home/img/transparent.gif')}}">
                            开通会员
                        </a>
                    </div>
                </div>
            </div>
            <!--用户头像 End-->
            <ul class="useratten clearfix">
                <li>
                    <a href="{{url('/home/mypost')}}">
                        <strong>1</strong>
                        <span>主帖</span>
                    </a>
                </li>
                {{--<li>--}}
                    {{--<a href="http://user.kdnet.net/index.asp?Redirect=fans">--}}
                        {{--<strong>0</strong>--}}
                        {{--<span>粉丝</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="no-line">--}}
                    {{--<a href="http://user.kdnet.net/index.asp?Redirect=follow">--}}
                        {{--<strong>0</strong>--}}
                        {{--<span>关注</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
            <!--关注按钮-->
            <!--//关注按钮-->
            {{--<div class="ad-xz-l clearfix">--}}
                {{--<a href="http://user.kdnet.net/index.asp?Redirect=honors">--}}
                    {{--<img src="{{asset('/home/img/ad_p1.png')}}" width="18" height="18">--}}
                {{--</a>--}}
                {{--<a href="javascript:;" >--}}
                    {{--<img src="{{asset('/home/img/ad_p2.png')}}" width="18" height="18">--}}
                {{--</a>--}}
            {{--</div>--}}
            <div class="detailed clearfix">
                <!--<div class="detailed-info underline">积分：<a href="javascript:;" onclick="KD.user.goto('integrallog',this);return false;">0</a></div> sunny 20131213 integral-->
                <div class="detailed-info">
                    积分：
                    <a href="javascript:;">{{$details -> score}}</a>
                </div>
            </div>
            <!-- sunny 打赏 B -->
            <div class="detailed clearfix">
                <div class="detailed-info" style="color:red">我的钱包</div>
                <div class="operating c-main">
                    <a href="https://qianbao.kdnet.net/" target="_blank">查询</a>
                </div>
            </div>
            <!-- sunny 打赏 E -->
            <div class="detailed clearfix">
                <div class="detailed-info">我的订单</div>
                <div class="operating c-main">
                    <a href="javascript:;">查询</a>
                </div>
            </div>
            <!-- 更多信息 -->
            <div class="more-show c-main" style="display: none;">
                <a href="javascript:;">更多信息</a>
            </div>
            <div class="detailed-more-cont" style="display: block;">
                <div class="detailed clearfix">
                    <div class="detailed-info">
                        <a href="javascript:;" onclick="usercheckemail()">Email：{{session('homeuser')->email}}</a>
                    </div>
                    {{--<div class="operating c-main">--}}
                        {{--<a href="javascript:;" onclick="usercheckemail()" >验证邮箱</a>--}}
                    {{--</div>--}}
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">手机：{{session('homeuser')->phone}}</div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">注册时间：{{date('Y/m/d H:i',$details ->regtime)}}</div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">上次登录：{{date('Y/m/d H:i',$details ->logintime)}}</div>
                </div>
                <div class="more-hide c-main">
                    <a href="javascript:;">隐藏更多</a>
                </div>
                <script type="text/javascript">
                    //更多个人信息显示、隐藏
                    $('.more-show').click(function() {
                        $(this).hide();
                        $('.detailed-more-cont').fadeIn();
                    });
                    $('.more-hide').click(function() {
                        $('.more-show').fadeIn();
                        $('.detailed-more-cont').hide();
                    });

                </script>
            </div>
            <!-- 更多信息 End -->
            <!--个人信息 End-->
            <!-- 导航 -->
            <ul class="user-nav clearfix">
                <li class="n3">
                    <div class="reme title">
                        <a href="http://user.kdnet.net/index.asp?Redirect=reme">回复我的</a>
                    </div>
                </li>
                <li class="n4">
                    <div class="reply title">
                        <a href="http://user.kdnet.net/index.asp?Redirect=reply">我的回复</a>
                    </div>
                </li>
                <li class="n5">
                    <div class="collection title">
                        <a href="http://user.kdnet.net/index.asp?Redirect=collection">我的收藏</a>
                    </div>
                </li>
                {{--<li class="n6">--}}
                    {{--<div class="sms title">--}}
                        {{--<!-- a href="javascript:;" onclick="KD.user.goto('sms',this);return false;">我的私信</a -->--}}
                        {{--<a href="http://user.kdnet.net/index.asp?Redirect=sms">我的私信</a>--}}
                    {{--</div>--}}
                    {{--<div class="operating c-main">--}}
                        {{--<!-- a href="javascript:;" onclick="KD.user.goto('sendSMS',this);return--}}
                        {{--false;">发信息</a -->--}}
                        {{--<a href="http://user.kdnet.net/index.asp?Redirect=sendSMS">发信息</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                <li class="n7">
                    <div class="topic title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('topic',this);return
                        false;">我的主帖</a -->
                        <a href="{{url('/home/mypost')}}">我的主帖</a>
                    </div>
                    <!--<div class="total">(1)</div>-->
                    <div class="operating c-main">
                        <a href="{{url('/home/post/create')}}" title="发布新帖"
                           target="_blank">发新帖</a>
                    </div>
                </li>
                <!-- -->
                <li class="n10">
                    <div class="recycle title">
                        <a href="http://user.kdnet.net/index.asp?Redirect=recycle">我的回收站</a>
                    </div>
                </li>
                <li class="n11 last">
                    <div class="title">
                        <a href="javascript:;" onclick="loginOut()">退出</a>
                    </div>
                </li>
            </ul>
            <!-- 导航 End -->
        </div>
        <div class="rf">
            {{--个人信息修改显示区域--}}
            @if (count($errors) > 0)
                <div class="alert" style="color:red;">
                    <ul>
                        @if(is_object($errors))
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @else
                            <li>{{  $errors }}</li>
                        @endif
                    </ul>
                </div>
            @endif
            <!-- TABS -->
            <ul class="tabs clearfix">
                <li onclick="userdetails()"><a href="javascript:;" id="userdetails" title="个人资料"><span>个人资料</span></a></li>
                <li onclick="userrepass()"><a href="javascript:;" id="userrepass" title="密码设置"><span>密码设置</span></a></li>
                <li onclick="usercheckemail()"><a href="javascript:;" id="usercheckemail" title="邮件验证"><span>邮件验证</span></a></li>
                <li onclick="userface()"><a href="javascript:;" id="userface" title="设置头像"><span>头像设置</span></a></li>
            </ul>
            <!-- TABS End -->
            <!--控制面板-->
            <!--个人资料-->
            <div style="height:100%" id="details">
                <form action="{{url('/home/updateuserinfo')}}" method="post" id="detailsform">
                    <div style="height:600px">
                        <div class="control-cont clearfix">
                            <div class="cpassword-box">
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">用户名： </div>
                                    <div class="cformfieldtext">
                                        <span>{{session('homeuser')->username}}</span>
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">姓名： </div>
                                    <div class="cformfieldtext">
                                        <input name="name" type="text" class="input-boder" style="width:100px" value="{{$details['name']}}">
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">性别： </div>
                                    <div class="cformfieldtext" >
                                        男:&nbsp;&nbsp;<input name="sex" type="radio"  value="1" {{ $details['sex']==1 ? 'checked' : '' }} style="vertical-align: middle;">&nbsp;&nbsp;
                                        女:&nbsp;&nbsp;<input name="sex" type="radio"  value="0" {{ $details['sex']==0 ? 'checked' : '' }}  style="vertical-align: middle;">
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">年龄： </div>
                                    <div class="cformfieldtext">
                                        <input name="age" type="text" class="input-boder" style="width:40px" value="{{$details['age']}}">&nbsp;&nbsp;岁
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">身份证号： </div>
                                    <div class="cformfieldtext">
                                        <input name="idnum" type="text" class="input-boder" style="width:100px" value="{{$details['idnum']}}">
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">地址： </div>
                                    <div class="cformfieldtext">
                                        <input name="address" type="text" class="input-boder" style="width:100px" value="{{$details['address']}}">
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">邮编： </div>
                                    <div class="cformfieldtext">
                                        <input name="postcode" type="text" class="input-boder" style="width:100px" value="{{$details['postcode']}}">
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">血型： </div>
                                    <div class="cformfieldtext">
                                        A:&nbsp;&nbsp;<input name="blood" type="radio"  value="A" {{ $details['blood']=="A" ? 'checked' : '' }}  style="vertical-align: middle;">
                                        B:&nbsp;&nbsp;<input name="blood" type="radio"  value="B" {{ $details['blood']=="B" ? 'checked' : '' }}  style="vertical-align: middle;">
                                        O:&nbsp;&nbsp;<input name="blood" type="radio"  value="O" {{ $details['blood']=="O" ? 'checked' : '' }}  style="vertical-align: middle;">
                                        保密:&nbsp;&nbsp;<input name="blood" type="radio"  value="X" {{ $details['blood']=="X" ? 'checked' : '' }}  style="vertical-align: middle;">
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">QQ： </div>
                                    <div class="cformfieldtext">
                                        <input name="qq" type="text" class="input-boder" style="width:100px" value="{{$details['qq']}}">
                                    </div>
                                </div><div class="cforminput clearfix">
                                    <div class="cformlabel">MSN： </div>
                                    <div class="cformfieldtext">
                                        <input name="msn" type="text" class="input-boder" style="width:100px" value="{{$details['msn']}}">
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <div class="btn-controlpanel">
                                    <a href="javascript:;" style="pandding-top:12px;" onclick="updateuserinfo()">保存</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--密码设置-->
            <div style="height:100%" id="repass">
                <form action="/home/repass" id="repassform" method="POST">
                    <input type="hidden" name="a" value="u">
                    <div class="gb-lb" id="cPassword">
                        <div class="control-cont clearfix">
                            <div style="color:red;"></div>
                            <div class="cpassword-box">

                                <div class="cforminput clearfix">
                                    <div class="cformlabel">旧密码确认：</div>
                                    <div class="cformfieldtext">
                                        <input name="password_o" type="password" class="input-boder" style="width:100px">
                                    </div>
                                </div>

                                <div class="cforminput clearfix">
                                    <div class="cformlabel">新密码：</div>
                                    <div class="cformfieldtext">
                                        <input name="password_n" type="password" class="input-boder" style="width:100px">
                                    </div>
                                </div>
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">新密码确认：</div>
                                    <div class="cformfieldtext">
                                        <input name="repassword_n" type="password" class="input-boder" style="width:100px">
                                    </div>
                                </div>
                            </div>
                            <div class="btn-controlpanel">
                                <a href="javascript:;" style="pandding-top:12px;" onclick="repass()">重置密码</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- 邮箱验证 -->
            <div style="height:100%" id="email">
                <form action="" method="post" id="emailform" name="form">
                    <div style="height:600px">
                        <div class="control-cont clearfix">
                            <div class="cpassword-box">
                                <div class="cforminput clearfix">
                                    <div class="cformlabel">邮箱： </div>
                                    <div class="cformfieldtext">
                                        <input name="checkemail" type="text" class="input-boder" style="width:200px" id="checkemail" value="{{session('homeuser')->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="btn-controlpanel">
                                <a href="javascript:;" style="pandding-top:12px;" onclick="sendmail()" >验证邮箱</a>
                            </div>
                        </div>
                        <div class="fillinfo">
                            <h1 class="c-alarm">验证后立即拥有社区发帖、回复权限！<span class="fB">收不到邮件？</span></h1>
                            <ul>
                                <li>1.尝试到广告邮件、垃圾邮件目录里找找看；</li>
                                <li>2.再次发送验证邮件</li>
                                <li>3.换个邮箱试试；</li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <!--设置头像-->
             <div style="height:100%" id="face">
                 <form action="" method="post" id="userfaceform">
                     <div style="height:600px">
                         <div class="control-cont clearfix">
                             <div class="cpassword-box">
                                 <div class="cforminput clearfix">
                                     <div class="cformlabel">用户头像： </div>
                                     <div class="cformfieldtext">
                                         {{--<input type="text" class="input-boder" id="art_thumb" name="profile" value="{{$details->profile}}">--}}
                                         <span id="art_thumb" style="display:none;">{{$details->profile}}</span>
                                         <p><img id="img1" src="{{$details->profile}}" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
                                     </div>
                                     <div style="clear:both;"></div><br /><br />
                                     <div class="cformfieldtext">
                                         {{--{{csrf_field()}}--}}
                                         <input id="file_upload" type="file" name="file_upload" onchange="uploadImage()" multiple="true">
                                     </div>
                                 </div>
                             </div>
                             <div class="btn-controlpanel">
                                     <a href="javascript:;" style="pandding-top:12px;" onclick="updateface()">上传头像</a>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
            <script>
                //修改用户详细信息
                function updateuserinfo(){
                    //询问框
                    layer.confirm('您确认修改个人信息吗？', {
                        btn: ['确认','取消']
                    }, function(){
                        //获取原始密码值
                        var name = $('input[name=name]').val();
                        var sex = $('input[name=sex]:checked').val();
                        var age = $('input[name=age]').val();
                        var idnum = $('input[name=idnum]').val();
                        var address = $('input[name=address]').val();
                        var postcode = $('input[name=postcode]').val();
                        var blood = $('input[name=blood]:checked').val();
                        var qq = $('input[name=qq]').val();
                        var msn = $('input[name=msn]').val();
                        var arr = {'name':name,'sex':sex,
                            'age':age,'idnum':idnum,'address':address,
                            'postcode':postcode,'blood':blood,'qq':qq,'msn':msn};

//                通过ajax 向服务器发送一个删除请求
                        $.post("{{url('/home/updateuserinfo/')}}",{'arr':arr,'_token':"{{csrf_token()}}"},function(data){

                            if(data.status == 0){
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
                //修改用户密码
                function repass(){
                    //询问框
                    layer.confirm('您确认修改密码吗？', {
                        btn: ['确认','取消']
                    }, function(){
                        //获取原始密码值
                        var password_o = $('input[name=password_o]').val();
                        var password_n = $('input[name=password_n]').val();
                        var repassword_n = $('input[name=repassword_n]').val();

//                通过ajax 向服务器发送一个删除请求
                        $.post("{{url('/home/repass/')}}",{'password_o':password_o,'password_n':password_n,'repassword_n':repassword_n,'_token':"{{csrf_token()}}"},function(data){

                            if(data.status == 0){
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
                //验证用户邮箱
                function sendmail(){
                    //获取邮件值
                    var email = $('#checkemail').val();
                    var regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;

                    if (!regex.test(email)) {
                        layer.msg("邮件格式不正确,请重新输入", {icon: 5});
                    } else {
                        // 通过ajax 向服务器发送一个删除请求
                        $.post("{{url('/home/sendmail/')}}",{'email':email,'_token':"{{csrf_token()}}"},function(data){

                            if(data.status == 0){
                                layer.msg(data.msg, {icon: 6});
                            }else{

                                layer.msg(data.msg, {icon: 5});
                            }
                        })
                    }


                }
                //修改用户头像
                function updateface(){
                    //  判断是否有选择上传文件
                    var imgPath = $("#file_upload").val();
                    if (imgPath == "") {
                        alert("请选择上传图片！");
                        return;
                    }
                    //判断上传文件的后缀名
                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                    if (strExtension != 'jpg' && strExtension != 'gif'
                        && strExtension != 'png' && strExtension != 'bmp') {
                        alert("请选择图片文件");
                        return;
                    }
                    //询问框
                    layer.confirm('您确认修改头像吗？', {
                        btn: ['确认','取消']
                    }, function(){
                        //获取原始密码值
                        var profile = $('#art_thumb').text();

//                通过ajax 向服务器发送一个删除请求
                        $.post("{{url('/home/updateface/')}}",{'profile':profile,'_token':"{{csrf_token()}}"},function(data){

                            if(data.status == 0){
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
            </script>
        </div>
    </div>
    <div class="n_gb_b"></div>
</div>
<!--内容 End-->
<a id="img_overlay_trigger" href="http://user.kdnet.net/index.asp?Redirect=setting"
   rel="#img_overlay"></a>
<div id="img_overlay" class="apple_overlay">
    <div class="close"></div>
    <img src="http://user.kdnet.net/index.asp?Redirect=setting" onload="imageOverlay.overlay().load();">
</div>
<!--尾部-->
<div id="globalfooter" class="">
    <div class="footer-box clearfix">
        <div class="logo" title="凯迪网络 主流声音">
            <a href="http://www.kdnet.net/">凯迪网络 主流声音</a>
        </div>
        <div class="copyright">
            Copyright &#169; 2000~2017
            <span class="c-main"><a href="http://www.kdnet.net/">kdnet.net</a></span>
            corporation. All Rights Reserved
            <br>
            <span class="c-sub">
                <a href="http://about.kdnet.net/brief.php">关于凯迪</a>|
                <a href="http://about.kdnet.net/join.php">合作联系</a>|
                <a href="http://about.kdnet.net/join.php">广告服务</a>|
                <a href="http://about.kdnet.net/copyright.php">法律声明</a>|
                <a href="http://about.kdnet.net/join-us.php">加入凯迪</a>|
                <a href="http://about.kdnet.net/sitemap.php">网站地图</a>
            </span>
        </div>
    </div>
</div>
<!--尾部 End-->
<!--script type="text/javascript" src="http://imgcdn.kdnet.net/webset/www/g_javascript/globalpanda.js"></script-->
<script src="{{asset('/home/js/log.js')}}">
</script>

</body>

</html>