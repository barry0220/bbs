<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <title>
        详情
    </title>
    <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"
    />
    <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"
    />
    <link rel="bookmark" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"
    />
    <link rel="apple-touch-icon" href="{{asset('/home/img/fav.png')}}" />
    <link rel="apple-touch-icon-precomposed" href="{{asset('/home/img/fav.png')}}"
    />
    <!-- sunny modify 20130710 收藏 begin -->
    <!-- link href="http://imgcdn.kdnet.net/webset/www/g_style/base8.css"
    rel="stylesheet" type="text/css" / -->
    <link href="{{asset('/home/css/base.css')}}" rel="stylesheet" type="text/css"
    />
    <!-- sunny modify 20130710 收藏 end -->
    <link href="{{asset('/home/css/face.css')}}" rel="stylesheet" type="text/css"
    />
    <link href="{{asset('/home/css/club.css')}}" rel="stylesheet" type="text/css"
    />
    <script src="{{asset('/home/js/jquery-2.1.1.js')}}" tppabs="{{asset('/home/js/jquery-1.12.0.min.js')}}">
    </script>

    <style type="text/css">
        .wlad-list { border: 1px solid #fff; padding: 3px 10px; } .wlad-list li
                                                                  { float: left; width: 33%; line-height: 22px; }
    </style>
</head>

<body id="ClubCont">
<!-- 顶部导航栏 -->
<div class="top-fixed-nav">
    <div class="nav-con ">
        <div class="nav-menu-left ">
            <a href="{{url('/')}}" target="_blank" class="lf nav-logo" title="凯迪网络">
                凯迪网络
            </a>
            <!-- 智能首页 -->
            <ul class="nav-menu nav-menu-intelligent lf now-in-intelligent">
                <!--<li class="btn-l"><a href="http://club.kdnet.net/myhome.asp" class="nav-option not-new"><b class="nav-icon nav-op-intelligent"></b>智能首页</a></li>-->
                <!-- li class="btn-r thinker"><a href="http://special.kcis.cn">思享者</a></li -->
            </ul>
            <!-- 智能首页 END-->
        </div>
        <div class="nav-menu-right">
            <div class="nav-user-msg-f rf">
                @if (session('homeuser'))
                    <div class="login-f">
                        <!-- 头部登录后右一列表 -->
                        <ul class="nav-menu nav-menu-other rf">
                            <li>
                                <a title="快速发帖" target="_blank" class="nav-option nav-icon nav-op-post nav-l"
                                   href="{{url('/home/post/create')}}">
                                </a>
                            </li>
                        </ul>
                        <!-- 头部登录后右一列表 END-->
                        <div class="nav-user-msg-f rf">
                            <!-- 头部登录后右二列表 -->
                            <a title="{{session('homeuser')->username}}" class="nav-user-logo" target="_blank"
                               href="{{url('/home/userinfo')}}">
                                <img onerror="this.src = duf_40_40;" alt="{{session('homeuser')->username}}"
                                     src="{{session('homeuser')->userface}}">
                                用户头像
                            </a>
                            <!-- 用户选项 -->
                        {{--
                        <div class="nav-menu-ex-f clearfix" id="mentex" style="display: none;">
                            --}} {{--
                                    <div class="nav-menu-ex">
                                        --}} {{--
                                        <i class="dot-ex">
                                        </i>
                                        --}} {{--
                                        <a target="_blank" href="{{url('/home/mypost')}}">
                                            <b class="nav-icon nav-op-mypost">
                                            </b>
                                            我的主帖
                                        </a>
                                        --}} {{--
                                        <a target="_blank" href="{{url('/home/myreplay')}}">
                                            <b class="nav-icon nav-op-myre">
                                            </b>
                                            我的回复
                                        </a>
                                        --}} {{--
                                        <a target="_blank" href="{{url('/home/mycollect')}}">
                                            <b class="nav-icon nav-op-mycollect">
                                            </b>
                                            我的收藏
                                        </a>
                                        --}} {{--
                                    </div>
                                    --}} {{--
                                </div>
                                --}}
                        <!-- 用户选项 end -->
                        </div>
                    </div>
                    <script>
                        function loginOut() {
                            //询问框
                            layer.confirm('确认退出登录吗？', {
                                    btn: ['确认', '取消']
                                },
                                function() {
                                    //                通过ajax 向服务器发送一个删除请求
                                    $.post("{{url('/home/loginout')}}", {
                                            "_token": "{{csrf_token()}}"
                                        },
                                        function(data) {

                                            if (data.status == 0) {
                                                layer.msg(data.msg, {
                                                    icon: 6
                                                });
                                                setTimeout(function() {
                                                        location.href = "{{url('/home/login')}}";
                                                    },
                                                    3000)
                                            } else {

                                                layer.msg(data.msg, {
                                                    icon: 5
                                                });
                                            }

                                        })

                                });
                        }
                    </script>
                @else
                    <div class="login-f">
                        <a href="{{url('/home/login')}}">
                            登录
                        </a>
                        <a href="{{url('/home/register')}}">
                            注册
                        </a>
                    </div>
                @endif {{--
                        <form id="form1" action="#" method="get" --}} {{--class="sear-box-trans rf pore">
                            --}} {{--
                            <a href="javascript:;" class="sear-bg">
                                --}} {{--
                                <input type="submit" name="sa" id="searchsubmit" value="" class="sear-go"
                                />
                                --}} {{--
                                <input name="q" type="text" id="s" onfocus="javascript:if(this.value==''){this.value='';this.className='sear-input sear-in';}"
                                --}} {{--onblur="javascript:if(this.value==''){this.value='';this.className='sear-input'}"
                                --}} {{--value="" class="sear-input" />
                                --}} {{--
                            </a>
                            --}} {{--
                        </form>
                        --}}
            </div>
        </div>
        <div class="nav-opacity">
        </div>
        <div class="nav-line-b">
        </div>
    </div>
</div>
<div class="nav-space-t">
</div>
<div class="ad-banner-left clearfix">
    <!--<div class="ad-banner-left-box" style="top:405px;"><!--对联物料-->
    <div class="ad-banner-left-box" style="top:100px;">
        <!--不是对联-->
        <div class="ad-banner-left-cont" id="ad-banner-left-cont">
            <div id="dispbbs87">
                <div id="BDad-left">
                </div>
            </div>
            <div class="kd-app-code close-code" style="height:auto;">
                <p class="close" title="关闭" onclick="$(this).parent('.close-code').hide();">
                    <b class="ico-newshare">
                    </b>
                </p>
                <div class="code-pans">
                    <div>
                        <img src="{{asset('/home/img/kd_app_1024.gif')}}" tppabs="{{asset('/home/img/kd_app_1024.gif')}}"
                             width="94" height="94" />
                        <div class="code-text-box" style="margin-bottom:30px;">
                            <a href="javascript:;">
                                凯迪社区客户端
                                <br />
                                v3.0版新鲜出炉
                                <br />
                                点击或扫描下载
                            </a>
                        </div>
                    </div>
                    <div>
                        <img src="{{asset('/home/img/kd_gongzhong.gif')}}" tppabs="{{asset('/home/img/kd_gongzhong.gif')}}"
                             width="94" height="94" />
                        <div class="code-text-box" style="margin-bottom:30px;">
                            凯迪微信公众号
                            <br />
                            扫描二维码关注
                            <br />
                            发现信息价值
                        </div>
                    </div>
                </div>
                <div class="code-tabs">
                    <a href="javascript:void(0);">
                        客户端
                    </a>
                    <a href="javascript:void(0);">
                        公众账号
                    </a>
                </div>
            </div>
            <!--add wetcha -->
            <!--左边固定wetcha BEGIN 分享-->
            <style>
                .wechat-share{ background-color: #fff; text-align: center; padding: 13px
                0; margin-top: 10px; border: 1px solid #BAD8D8; width: 113px; position:
                        absolute; right: 0px; } .wechat-share i{ background: url("{{asset('/home/img/icon-wetcha.png')}}")
                no-repeat; width: 15px; height: 13px; display: inline-block; float: left;
                                                    margin-top: 3px; } .wechat-share p{ color: #555659; font-size: 13px; text-align:
                        left; margin-left:20px; margin-top: 12px; } .wetchat-share-txt{ padding:
                        0 13px; }
            </style>
            <!--左边固定wetcha END 分享-->
            <!--左边固定wetcha BEGIN 分享html-->
            <div class="wechat-share">
                <div id="topic-qrcode" style="display:block;width:94px;margin:0 auto;">
                </div>
                <div class="wetchat-share-txt">
                    <i>
                    </i>
                    <p>
                        微信扫一扫
                        <br>
                        分享此帖文
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .ad-banner-left{ height:0; width:1030px; margin:0 auto; position:relative;}
    .ad-banner-left-box{width:120px; height:240px; position:absolute; left:-120px;
        z-index:1000;} .ad-banner-left-cont{ width:120px; height:240px; position:absolute;}
</style>
<!-- **************************************weizi [2013-10-14] 新增加社区内容页左侧广告
********************************************** End -->
<div id="TopScrollDiv" class="topscroll-div">
</div>
<!-- 内容 -->
<div class="wrapper clearfix w1030px">
    <!-- // 左边内容 -->
    <div class="lf w840px">
        <!--主导航-->
        <div class="globalnav c-white clearfix">
            <ul class="globalnav-ul">
                <li>
                    <a href="{{url('/')}}" tppabs="http://www.kdnet.net/" class="current">
                        首页
                    </a>
                    |
                </li>
                <li>
                    <a href="{{url('home/post')}}" tppabs="http://www.kdnet.net/club/index">
                        凯迪社区
                    </a>
                    |
                </li>
            </ul>
        </div>
        <!--//主导航-->
        <!--头部-->
        <div class="header clearfix">
            <div class="logo" title="凯迪社区">
                <a href="{{url('/')}}">
                </a>
                <div class="logo-ms">
                </div>
            </div>
            <div class="forum" title="{{$postinfo->pname}}">
                <a href="javascript:;">
                    {{$postinfo->pname}}
                </a>
            </div>
            <div style="width:550px;margin:0 auto; margin-top:10px; height:90px;overflow:hidden;">
            </div>
            <!--modify sunny 20131231 ad-->
        </div>
        <!--当前位置-->
        <div class="club-location clearfix">
            <div class="c-main">
                <a href="{{url('/')}}">
                    首页
                </a>
            </div>
            <div class="arrow">
            </div>
            <div class="c-main">
                <a href="{{url('home/post')}}">
                    凯迪社区
                </a>
            </div>
            <div class="arrow">
            </div>
            <!--<div class="c-main"><a href="http://club.kdnet.net/index.asp#68" target="_blank">猫论天下</a></div>-->
            <!--<div class="arrow"></div>-->
            <div class="c-main">
                <a href="{{url('home/plateslist/'.$postinfo->pid)}}">
                    {{$postinfo->pname}}
                </a>
            </div>
            <div class="arrow">
            </div>
        </div>
        <!--//当前位置！-->
        <div class="clubcont-line ">
        </div>
        <div class="banner b-border" id="club_dispbbs_l_1" style="text-align:right;">
            <script type="text/javascript">
                //<![CDATA[
                ac_as_id = "mm_34021018_13540158_79140215";
                ac_format = 1;
                ac_mode = 1;
                ac_group_id = 1;
                ac_server_base_url = "afpeng.alimama.com/";
                //]]>

            </script>
            <img src="{{asset('/home/img/05ce64af34d70599737afcec1bfee292.png')}}"
                 alt="" style="width:822px;" />
            <script type="text/javascript" src="{{asset('/home/js/k.js')}}">
            </script>
        </div>
        <!--发帖等操作-->
        <div class="operating clearfix">
            <div class="btn-publish" title="发布新帖">
                <a href="{{url('/home/post/create')}}">
                    发布新帖
                </a>
            </div>
            <div class="btn-reply" title="跟帖回复">
                <a href="#Preply">
                    跟帖回复
                </a>
            </div>
        </div>
        <!--发帖等操作 End-->
        <div class="posted-box-add">
            <div class="posted-box clearfix">
                <a name="72000715">
                </a>
                <div class="posted-info c-sub">
                    发帖人：
                    <span class="name" id="userinfo_1">
                                <div class="usertips clearfix box1" id="detailinfo_1">
                                </div>
                                <input id="input" type="hidden" value="{{$postinfo->id}}" />
                                <input id="author" type="hidden" value="{{$postinfo->uid}}" />
                                <span class="name c-main">
                                    <a href="javascript:;" target="_blank">
                                        {{$postinfo->username}}
                                    </a>
                                </span>
                                <a href="javascript:;" target="_blank">
                                    <img class="vip-icon" title="凯迪认证" src="{{asset('/home/img/transparent.gif')}}"
                                    />
                                </a>
                            </span>
                    &nbsp;
                    <a href="javascript:;" target="_blank">
                        <img class="member-icon" title="凯迪会员" src="{{asset('/home/img/transparent.gif')}}"
                             tppabs="{{asset('/home/img/transparent.gif')}}" />
                    </a>
                    &nbsp;
                    <a href="javascript:;" target="_blank">
                        <img class="author-icon" title="原创作者" src="{{asset('/home/img/transparent.gif')}}"
                        />
                    </a>
                    |&nbsp; {{--
                            <a onclick="openSesPopup_new()" href="javascript:;">
                                --}} {{--只看此人--}} {{--
                            </a>
                            --}}
                </div>
                <div class="posted-floor">
                            <span class="c-sub">
                                <span id="dispbbs33" style="width:0;height:0;visibility:hidden;overflow:hidden;">
                                </span>
                            </span>
                    &nbsp;&nbsp;&nbsp;楼主
                </div>
            </div>
            <div class="c-sub minor-control">
                <!-- sunny add 20130710 begin -->
                <!-- 收藏 -->
                <div class="collection-f prompt-f">
                            <span class="collection-btn">
                                <a href="javascript:;" title="收藏" id="collection" onclick="openLoginPopup();">
                                    收藏
                                </a>
                            </span>
                </div>
                <!-- 收藏 end -->
                <!-- sunny add 20130710 end -->
                <b class="c-sub">
                    |
                </b>
                <a href="javascript:window.location.reload()">
                    刷新
                </a>
                <b class="c-sub">
                    |
                </b>
                <a href="javascript:doZoom(-2)">
                    字体缩小
                </a>
                <b class="c-sub">
                    |
                </b>
                <a href="javascript:doZoom(2)">
                    字体变大
                </a>
            </div>
            <!--针对内容页视频样式-->
            <style>
                .postspecific .posts-cont iframe, .replycont-box-r .replycont-text iframe{
                    display: block; width:100%; height:400px; margin:0 auto;}
            </style>
            <script>
                //收藏帖子
                $('#collection').click(function() {
                    var postid = $('#input').val();
                    $.post("{{url('home/collection')}}", {
                            '_token': '{{csrf_token()}}',
                            'postid': postid
                        },
                        function(data) {
                            if (data.status == 0) {
                                location.href = location.href;
                                layer.msg(data.msg, {
                                    icon: 6
                                });
                            } else if (data.status == 2) {
                                location.href = location.href;
                                layer.msg(data.msg, {
                                    icon: 1
                                });
                            } else {
                                location.href = location.href;
                                layer.msg(data.msg, {
                                    icon: 5
                                });
                            }
                        });

                })
            </script>
            <div class="postspecific">
                <div class="posts-title">
                    {{$postinfo->title}}
                    <input type="hidden" id="postid">
                </div>
                <div class="posts-stat-box">
                    <div class="posts-stat-t">
                    </div>
                    <div class="posts-stat-c">
                        <div>
                                    <span class="f10px fB c-alarm">
                                        {{$postinfo->clickcount}}
                                    </span>
                            次点击
                        </div>
                        {{--
                        <div class="forward-wblog">
                            --}} {{--
                                    <span class="f10px fB c-alarm">
                                        --}} {{--{{$postinfo->replaycount}}--}} {{--
                                    </span>
                                    --}} {{--个回复--}} {{--
                                </div>
                                --}}
                        <div>
                        </div>
                        <div class="forward-wblog">
                        </div>
                    </div>
                    <div class="posts-stat-b">
                    </div>
                </div>
                <div class="posts-posted">
                            <span class="c-main">
                                <a href="javascript:;" tppabs="http://user.kdnet.net/index.asp?userid=11849785"
                                   target="_blank">
                                    {{$postinfo->username}}
                                </a>
                            </span>
                    于 {{date('Y-m-d H:i:s',$postinfo->posttime)}}发布在
                    <span class="c-main">
                                <a href="{{url('/home/post')}}" tppabs="http://club.kdnet.net/">
                                    迷之社区
                                </a>
                                &gt;
                                <a href="{{url('/home/plateslist/').'/'.$postinfo->pid}}" tppabs="http://club.kdnet.net/list.asp?boardid=1">
                                    {{$postinfo->pname}}
                                </a>
                            </span>
                </div>
                <div class="posts-cont" style="word-spacing: 2px;">
                    <br>
                    <img src="{{asset('/home/img/15076016546630413.jpg-imageView2-0-h-600.jpg')}}">
                    <br>
                    {!!$postinfo->content!!}
                    <br>
                    <span class="name c-main">
                                <a target="_blank" href="javascript:;" class="tips" title="风青杨V" onMouseOut="mOut();">
                                </a>
                            </span>
                    &nbsp;&nbsp;
                    <br>
                    <br>
                </div>
                <!--转贴-->
                <!-- sunny 20131021 share begin -->
                <!--分享、app下载 S-->
                <div class="new-share-main">
                    <div class="new-share">
                                <span class="lf">
                                    分享：
                                </span>
                        <a href="javascript:void(0)" onclick="postToWb('sina', '1', '12447302');"
                           title="分享到新浪微博" class="ico-newshare ico-sina">
                            分享到新浪微博
                        </a>
                        <a href="javascript:void(0)" onclick="postToWb('tx', '1',  '12447302');"
                           title="分享到腾讯微博" class="ico-newshare ico-qqt">
                            分享到腾讯微博
                        </a>
                        <span class="code-main">
                                    <a href="javascript:;" title="分享给朋友" class="ico-newshare ico-shareurl"
                                       id="qrcodebtn">
                                        分享给朋友
                                    </a>
                                    <div class="shareurl-code close-code" style="display: none;">
                                        <b class="ico-newshare close" title="关闭" onclick="$(this).parent('.close-code').hide();">
                                        </b>
                                        <div class="shareurl-text clearfix">

                                            <div src="" width="74" height="74" id="qrcodeimg">
                                            </div>
                                            <p>
                                                用手机看帖文，请扫一扫。用微信/易信等扫描还可以分享至好友和朋友圈。
                                            </p>
                                        </div>
                                    </div>
                                </span>
                    </div>
                </div>
                <!--分享、app下载 E-->
                <!-- sunny 20131021 share end -->
                <!-- Sunny Modify Begin <div align=right>
                <span>分享到</span>
                <a href="javascript:void(0)" onclick="postToWb('tx', '1',  '12447302');" title="分享到腾讯微博"><img src="http://v.t.qq.com/share/images/s/weiboicon16.png" style="margin-bottom:-4px"></a>
                <a href="javascript:void(0)" onclick="postToWb('sina', '1', '12447302');" title="分享到新浪微博"><img src="http://www.sinaimg.cn/blog/developer/wiki/LOGO_16x16.png" style="margin-bottom:-4px"></a>
                <span class="change_btn"><span class="type3 showNum"><span id="count_p" class="number"><em id="count">1</em><img src="http://simg.sinajs.cn/platformstyle/images/common/transparent.gif" class="arrow" alt="" /></span></span></span>
                </div>
                Sunny Modify E于 2017/10/10 10:14:24 发布在nd -->
                <!--转贴结束-->
                <!--sunny 打赏 B -->
                <!--chung 打赏 B -->
                <!-- 赞赏 -->
                <div id="re_test">
                    <!-- ?????? -->
                    <!-- 赞赏html -->
                    <div class="donate-Main clearfix">
                        {{--判断用户是否登录--}} @if(session('homeuser')) @if($admireortread == '0') {{--原始显示--}}
                        <div class="donate-btn-warp" id="showall">
                            <a onclick="doadmire();" style="float: left;margin-left: 200px" class="reward-btn-big  donate-btn doadmire "
                               href="javascript:void(0);">
                                赞
                            </a>
                            <a onclick="dotread();" style="float: right; margin-right: 200px" class="reward-btn-big  donate-btn "
                               href="javascript:void(0);">
                                踩
                            </a>
                        </div>
                        @elseif($admireortread == '1') {{--已赞--}}
                            <div class="donate-btn-warp" id="showadmire">
                                <a onclick="downadmire();" style="float: left;margin-left: 250px;width:80px"
                                   class="reward-btn-big  donate-btn " href="javascript:void(0);">
                                    已点赞
                                </a>
                            </div>
                        @elseif($admireortread == '2') {{--已踩--}}
                            <div class="donate-btn-warp" id="showthead">
                                <a onclick="downtread();" style="float:left ; margin-left: 250px;width:80px"
                                   class="reward-btn-big  donate-btn " href="javascript:void(0);">
                                    已点踩
                                </a>
                            </div>
                        @else
                            <div class="donate-btn-warp" id="showelse">
                                <a onclick="doadmire()" style="float: left;margin-left: 200px" class="reward-btn-big  donate-btn"
                                    href="javascript:;">
                                    赞
                                </a>
                                <a onclick="dotread();" style="float: right; margin-right: 200px" class="reward-btn-big  donate-btn "
                                   href="javascript:void(0);">
                                    踩
                                </a>
                            </div>
                        @endif @else
                            <div class="donate-btn-warp" id="showelse">
                                <a onclick="nologin()" style="float: left;margin-left: 200px" class="reward-btn-big  donate-btn "
                                   href="javascript:void(0);">
                                    赞
                                </a>
                                <a onclick="nologin();" style="float: right; margin-right: 200px" class="reward-btn-big  donate-btn "
                                   href="javascript:void(0);">
                                    踩
                                </a>
                            </div>
                        @endif
                    </div>
                    <script>
                        //赞赏帖子专用JS
                        function nologin() {
                            location.href = location.href;
                            layer.msg('您还没有登录,无权限操作', {
                                icon: 5
                            });
                        }

                        //点击赞赏
                        function doadmire() {
                            var postid = $('#input').val();
                            $.post("{{url('home/doadmire')}}", {
                                    '_token': '{{csrf_token()}}',
                                    'postid': postid
                                },
                                function(data) {
//                                    alert(111111);
                                    if (data.status == 0) {

                                        location.href = location.href;
                                    } else {
                                        location.href = location.href;
                                        layer.msg(data.msg, {
                                            icon: 5
                                        });
                                    }
                                });
                        };
                        //点击踩
                        function dotread() {
                            var postid = $('#input').val();
                            $.post("{{url('home/dotread')}}", {
                                    '_token': '{{csrf_token()}}',
                                    'postid': postid
                                },
                                function(data) {
                                    if (data.status == 0) {
                                        location.href = location.href;
                                    } else {
                                        location.href = location.href;
                                        layer.msg(data.msg, {
                                            icon: 5
                                        });
                                    }
                                });
                        };
                        //点击取消赞
                        function downadmire() {
                            var postid = $('#input').val();
                            $.post("{{url('home/downadmire')}}", {
                                    '_token': '{{csrf_token()}}',
                                    'postid': postid
                                },
                                function(data) {
                                    if (data.status == 0) {
                                        location.href = location.href;
                                    } else {
                                        location.href = location.href;
                                        layer.msg(data.msg, {
                                            icon: 5
                                        });
                                    }
                                });
                        };
                        //点击取消踩
                        function downtread() {
                            var postid = $('#input').val();
                            $.post("{{url('home/downtread')}}", {
                                    '_token': '{{csrf_token()}}',
                                    'postid': postid
                                },
                                function(data) {
                                    if (data.status == 0) {
                                        location.href = location.href;
                                    } else {
                                        location.href = location.href;
                                        layer.msg(data.msg, {
                                            icon: 5
                                        });
                                    }
                                });
                        };
                    </script>
                </div>

                <script>
                    function closeR() {
                        $('.reward-fixed').fadeOut(300);
                    }
                </script>
                <!--chung 打赏 E -->
                <!--sunny 打赏 E -->
            </div>
        </div>
        <div class="banner b-border">
            <div id="dispbbs29" style="width:822px;height:0;visibility:hidden;overflow:hidden;">
                <div style="width:822px;margin:0 auto; height:90px; overflow:hidden;">
                    <!-- 54576801：内容页横幅1 类型：固定 尺寸：728x90-->
                    <script type="text/javascript">
                        //<![CDATA[
                        ac_as_id = "mm_34021018_13540158_54576801";
                        ac_format = 1;
                        ac_mode = 1;
                        ac_group_id = 1;
                        ac_server_base_url = "afpeng.alimama.com/";
                        //]]>

                    </script>
                    <img src="/home/img/fc5eab3d370c13e0cdc6e83b2967c79f.png" alt="" style="width:822px;"
                    />
                    <img src="/home/img/9cb145c1827683604bd61c0198b89041.png" alt="" style="width:822px;"
                    />
                    <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                    </script>
                </div>
            </div>
        </div>
        <!-- a name="Preply" id="Preply"></a -->
        <div style="height:10px;border:1px solid #fff;border-width:0 1px 0 1px;">
        </div>
        <div class="banner b-border">
            <div id="dispbbs113" style="width:820px;visibility:hidden;overflow:hidden;">
                <!--内容页METRO：2014-07-31-->
                <div style="width:728px;margin:0 auto; height:90px; overflow:hidden;">
                    <!-- 54576790：内容页横幅2 类型：固定 尺寸：728x90-->
                    <script type="text/javascript">
                        //<![CDATA[
                        ac_as_id = "mm_34021018_13540158_54576790";
                        ac_format = 1;
                        ac_mode = 1;
                        ac_group_id = 1;
                        ac_server_base_url = "afpeng.alimama.com/";
                        //]]>

                    </script>
                    <script type="text/javascript" src=" {{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                    </script>
                </div>
                <div style="height:10px;border:1px solid #fff;border-width:0 1px 0 1px;">
                </div>
            </div>
        </div>
    @foreach($replay as $k => $v)
        <!--回复-->
            <div class="reply-box" id="72000998" style="display:block">
                <div class="posted-box clearfix">
                    <a name="72000998">
                    </a>
                    <div class="posted-info c-sub">
                        回帖人：
                        <div class="name" id="userinfo_2">
                            <div class="usertips clearfix box1" id="detailinfo_2">
                            </div>
                            <span class="name c-main">
                                    <a href="#">
                                        {{$v->username}}
                                    </a>
                                </span>
                            <a href="#">
                                <img class="phone-icon" title="手机绑定用户" src="{{asset('/home/img/transparent.gif')}}"
                                     tppabs="{{asset('/home/img/transparent.gif')}}" />
                            </a>
                            &nbsp;
                        </div>
                    {{date('Y-m-d H:i:s',$v->time)}}
                    <!-- 2017/10/10 10:24:31 &nbsp;&nbsp; -->
                        <a href="" tppabs="http://3g.kdnet.net/app.php" target="_blank">
                            跟帖回复：
                        </a>
                    </div>
                    <div class="posted-floor">
                            <span class="c-sub">
                                <span id="dispbbs34" style="width:0;height:0;visibility:hidden;overflow:hidden;">
                                </span>
                            </span>
                        &nbsp;&nbsp;&nbsp; 第
                        <span id="floor">
                                <!-- <a href="#" onclick="javascript:showExposeMask('72000998', '1');return
                                false;" id="floor1">
                                第{{$k+1}}楼
                                </a> -->
                                    {{$k+1}}
                            </span>
                        楼
                    </div>
                </div>
                <div class="replycont-box clearfix">
                    <div class="replycont-box-l">
                            <span class="c-main">
                            </span>
                    </div>
                    <div class="replycont-box-r">
                        <div class="replycont-text" style="word-spacing: 2px;">
                            {!!$v->content!!}
                        </div>
                        <!--sunny 打赏 B -->
                        <!--sunny 打赏 E -->
                    </div>
                </div>
                <div class="c-main posts-control c-sub">
                    <!-- IP,曾用名 -->
                    <div style="float:left;">
                    </div>
                    <!-- // IP,曾用名 -->
                    <!-- sunny 打赏 E -->
                    <span id="ding_72000998">
                        </span>
                    <!--<b class="c-sub">|</b>-->
                <!-- <a href="{{url('home/post/relative/'.$v->uid)}}" onclick="openLoginPopup();"> -->
                    <a href="#Preply" id="re" onclick="replay()">
                        回复
                    </a>
                    |
                    <a href="#" tppabs="http://upfile1.kdnet.net/textareaeditor/quote.asp?boardid=1&followup=72000998&rootid=12447302&lay=2">
                        引用
                    </a>
                    <b class="c-sub">
                        |
                    </b>
                    <span class="c-alarm fB" title="举报">
                            <a href="javascript:;" onclick="openLoginPopup();" title="举报">
                                举报
                            </a>
                        </span>
                </div>
            </div>
            <!--回复 End-->
    @endforeach
    <!-- sunny 20130925 begin -->
        <!-- 回复 -->
        <!-- 弹窗 -->
        <div id="uplBoxF" class="upl-box-f">
            <div id="uplBoxFC" class="upl-box">
                <div id="editorSay" class="show-window" style="width:500px;">
                    <div class="w-title">
                                <span style="font-weight:bold;cursor:default;" id="w-title">
                                </span>
                        <a class="rf close-x" onClick="hideExposeMask();">
                        </a>
                    </div>
                    <div class="w-content">
                        <div style="padding-top:0; padding-bottom:0; margin-top:-5px; line-height:30px;">
                            <div style="padding:1px 1px 1px 1px; margin-top:3px;">
                                <input type="text" name="w-content" id="w-content" size="70" />
                            </div>
                        </div>
                        <div class="rf btn-group clearfix">
                            <input class="button" style="width:80px; margin-right:10px;" type="button"
                                   id="yesButton" name="yesButton" onclick='copyToClipboard();' value=" 复制 ">
                            <input class="button-c" type="button" name="noButton" onclick="hideExposeMask();"
                                   value=" 取消 ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="exposeMask">
        </div>
        <!-- sunny 20130925 end -->
        <!-- 弹窗 end -->
        <!--发帖/分页-->
        <link href="{{asset('/home/css/paginate.css')}}" rel="stylesheet" type="text/css">
        <div class="pagination">
            {!! $replay->render()!!}
        </div>
        <div class="operating clearfix">
            <div class="btn-publish" title="发布新帖">
                <a href="{{url('/home/post/create')}}">
                    发布新帖
                </a>
            </div>
            <div class="pages">
                <div class="pagesmodule">
                            <span class="c-sub">
                                共
                                <span class="c-alarm">
                                    {{$postinfo->clickcount}}
                                </span>
                                次点击，
                                <span class="c-alarm">
                                    {{$postinfo->replaycount}}
                                </span>
                                个回复
                            </span>
                    &nbsp;
                </div>
            </div>
        </div>
        <!--modify sunny 20131231 ad E-->
        <a name="Preply" id="Preply">
        </a>
        <div style="height:10px;border:1px solid #fff;border-width:0 1px 0 1px;">
        </div>
        <div class="clubcont-line ">
        </div>
        <script type="text/javascript" src="{{asset('./ueditor/ueditor.config.js')}}">
        </script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="{{asset('./ueditor/ueditor.all.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('./ueditor/jquery-1.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('layer/layer.js')}}">
        </script>
        <!-- 加载编辑器的容器 -->
        <!--发表评论-->
        <div id="btn1" class="quick-reply">
            <!-- 配置文件 -->
            <script id="container" name="content" type="text/plain">
                        请写入内容
                    </script>
            <!-- <div id="btn" href="javascript:;">发布</div>s -->
            {{--
            <button id="btn">
                评论
            </button>
            --}}
            <div class="btn-publish" title="评论">
                <a href="javascript:;" id="btn">
                    评论
                </a>
            </div>
        {{--
        <div style="display:none" id="hideuid">
            {{session('homeuser')->id}}
        </div>
        --}}
        <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container', {
                    //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
                    toolbars: [['FullScreen', 'Source', 'Undo', 'Redo', 'bold', 'test', 'simpleupload', 'fontfamily', 'fontsize', 'bold', 'italic', 'justifyleft', 'justifycenter', 'horizontal']],
                    //focus时自动清空初始化时的内容
                    autoClearinitialContent: true,
                    //关闭字数统计
                    // wordCount:false,
                    //关闭elementPath
                    elementPathEnabled: false,
                    //默认的编辑区域高度
                    initialFrameHeight: 300
                    //更多其他参数，请参考ueditor.config.js中的配置项
                });

                //对编辑器的操作最好在编辑器ready之后再做
                ue.ready(function() {
                    var id = $('#input').val();
                    $('#btn').click(function() {
                        //                                     获取html内容
                        var content = ue.getContent();
                        //                                    var uid = $('#hideuid').text();
                        $.post("{{url('home/replay')}}", {
                                '_token': "{{csrf_token()}}",
                                'content': content,
                                'id': id
                            },
                            function(data) {
                                if (data.status == 0) {
                                    location.href = location.href;

                                    layer.msg(data.msg, {
                                        icon: 6
                                    });

                                } else {
                                    location.href = location.href;
                                    layer.msg(data.msg, {
                                        icon: 5
                                    });
                                }
                                //                                    console.log(data);
                            });

                    });
                });
            </script>
        </div>
        <!--发表回复-->
        <div id="btn2" class="quick-reply1" style="display: none;">
            <div>
                <!-- <a id="btn" href="javascript:;">发布</a> -->
                <script id="container1" name="content" type="text/plain">
                            请写入内容
                        </script>
                <button id="btn3">
                    回复
                </button>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var uea = UE.getEditor('container1', {
                        //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
                        toolbars: [['FullScreen', 'Source', 'Undo', 'Redo', 'bold', 'test', 'simpleupload', 'fontfamily', 'fontsize', 'bold', 'italic', 'justifyleft', 'justifycenter']],
                        //focus时自动清空初始化时的内容
                        autoClearinitialContent: true,
                        //关闭字数统计
                        // wordCount:false,
                        //关闭elementPath
                        elementPathEnabled: false,
                        //默认的编辑区域高度
                        initialFrameHeight: 300
                        //更多其他参数，请参考ueditor.config.js中的配置项
                    });

                    //对编辑器的操作最好在编辑器ready之后再做
                    uea.ready(function() {
                        var postid = $('#input').val();
                        var author = $('#author').val();
                        $('#btn3').click(function() {
                            // 获取html内容
                            var content = uea.getContent();
                            //                                     var uid = $('#hideuid').text();
                            $.post("{{url('home/rep')}}", {
                                    '_token': "{{csrf_token()}}",
                                    'content': content,
                                    'postid': postid,
                                    'author': author
                                },
                                function(data) {
                                    if (data.status == 0) {
                                        location.href = location.href;
                                        layer.msg(data.msg, {
                                            icon: 6
                                        });
                                    } else {
                                        location.href = location.href;
                                        layer.msg(data.msg, {
                                            icon: 5
                                        });
                                    }
                                    // console.log(data);
                                });
                            // alert(12345678);
                        });
                    });
                </script>
            </div>
        </div>
        <script>
            function replay() {

                // $('#btn1').style.display="none";
                // $('#btn2').style.display="";
                // alert($);

                document.getElementById("btn1").style.display = "none";

                //         // document.getElementById("btn2").removeattr('style');
                document.getElementById("btn2").style.display = "";

                // alert(1234);
            }
        </script>
        <!-- //发表回复 -->
        <div class="banner b-border" id="club_dispbbs_l_5">
        </div>
        <!--尾部-->
        <div class="footer-club">
            <p class="links">
                友情链接：
            </p>
            @foreach(config('linksconfig') as $k => $v)
                <a target="_blank" href="{{$k}}">
                    {{$v}}
                </a>
            @endforeach
            <p class="state">
                {{config('webconfig.law')}}
            </p>
            <div class="copyright">
                {{config('webconfig.copyright')}}
            </div>
        </div>
        <!--尾部 End-->
    </div>
    <!-- // 左边内容 -->
    <div class="rf w188px web-right clearfix ">
        <!-- 右边内容 -->
        <div class="rf w180px clearfix ">
            <div class="space10 ">
            </div>
            <div style="position:relative; z-index:1; ">
                <div id="dispbbs39 " style="width:0;height:0;visibility:hidden;overflow:hidden; ">
                    <!-- 93937：内容页固定位——右矩形1 类型：固定广告位 尺寸：200x200-->
                    <!-- 54576830：内容页右矩形1 类型：固定 尺寸：200x200-->
                    <script type="text/javascript ">
                        //<![CDATA[
                        ac_as_id = "mm_34021018_13540158_54576830 ";
                        ac_format = 1;
                        ac_mode = 1;
                        ac_group_id = 1;
                        ac_server_base_url = "afpeng.alimama.com/ ";
                        //]]>

                    </script>
                    <script type="text/javascript " src="{{asset( '/home/js/k.js')}} " tppabs="{{asset(
                            '/home/js/k.js')}} ">
                    </script>
                </div>
            </div>
            <div class="space10 ">
            </div>
            <div style="position:relative; z-index:1; ">
                <div id="dispbbs112 " style="width:0;height:0;visibility:hidden;overflow:hidden; ">
                    <!--内容页右矩形2 2014-05-13-->
                    <div style="position: relative; display: inline; border: none; padding: 0px; margin:
                            0px; visibility: visible; overflow: hidden; ">
                        <!-- 54576788：内容页右矩形2 类型：固定 尺寸：200x200-->
                        <script type="text/javascript ">
                            //<![CDATA[
                            ac_as_id = "mm_34021018_13540158_54576788 ";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/ ";
                            //]]>

                        </script>
                        <script type="text/javascript " src="{{asset( '/home/js/k.js')}} " tppabs="{{asset(
                                '/home/js/k.js')}} ">
                        </script>
                    </div>
                    <!--内容页右矩形2 2014-05-13 end-->
                </div>
            </div>
            <div class="space10 ">
            </div>
            <div style="position:relative; z-index:1; ">
                <div id="dispbbs40 " style="width:0;height:0;visibility:hidden;overflow:hidden; ">
                    <!--内容页右矩形3：2014-7-4-->
                    <div style="position: relative; display: inline; border: none; padding: 0px; margin:
                            0px; visibility: visible; overflow: hidden; ">
                        <!-- 54576798：内容页右矩形3 类型：固定 尺寸：200x200-->
                        /
                        <script type="text/javascript ">
                            //<![CDATA[
                            ac_as_id = "mm_34021018_13540158_54576798 ";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/ ";
                            //]]>

                        </script>
                        <script type="text/javascript " src="{{asset( '/home/js/k.js')}} " tppabs="{{asset(
                                '/home/js/k.js')}} ">
                        </script>
                    </div>
                </div>
            </div>
            <div class="space10 ">
            </div>
            <div class="gb-coffee ">
                <div class="gb-t ">
                    <div class="gb-tl ">
                    </div>
                    <div class="title ">
                        <a href="javascript:;">
                            精彩推荐
                        </a>
                    </div>
                    <div class="gb-tr ">
                    </div>
                </div>
                <div class="gb-c ">

                    <ul class="hot-list-club ">
                        <li>
                            <div id="dispbbs43 " style="width:0;height:0;visibility:hidden;overflow:hidden; ">
                            </div>
                        </li>
                        <li>
                            <div id="dispbbs44 " style="width:0;height:0;visibility:hidden;overflow:hidden; ">
                            </div>
                        </li>
                        <li>
                            <div id="dispbbs45 " style="width:0;height:0;visibility:hidden;overflow:hidden; ">
                            </div>
                        </li>
                        <li>
                            <div id="dispbbs46 " style="width:0;height:0;visibility:hidden;overflow:hidden; ">
                            </div>
                        </li>
                        <li class="no-border ">
                            <div style="text-align:right; ">
                                广告
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>