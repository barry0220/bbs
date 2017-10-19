<!DOCTYPE html>

<html>


<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta property="qc:admins" content="15033067352456645346346546654"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        凯迪网络 - 主流声音，全球知名华人网络互动媒体
    </title>
    <meta name="author" content="凯迪网络">
    <meta name="keywords" content="凯迪,社区,凯迪网络,凯迪社区,深水区,猫眼看人,政经,思想,媒体,公共观察,舆情观察">
    <meta name="description"
          content="凯迪网络（www.kdnet.net），伴随中国互联网和网民共同成长，从中国第一代网络论坛发轫，凯迪以“客观、公正、理性、宽容”为宗旨，聚集了一千多万中高端注册用户，已发展成为中国最具代表性的互联网UGC （用户生成内容）平台之一，其中“猫眼看人”版块至今已连续十年在全国所有社区论坛版块中排名第一。凯迪网络全面启动新战略：专注于文化、财经、社会内容，面向互联网年轻一代打造新型服务。">
    <meta name="copyright" content="凯迪网络版权所有"/>
    <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('/home/css/bootstrap.css')}}" type="text/css"/>
    <script src="{{asset('/home/js/bootstrap.js')}}" tppabs="{{asset('/home/js/bootstrap.js')}}"></script>
    <script src="{{asset('/home/js/jquery.js')}}" tppabs="{{asset('/home/js/jquery.js')}}"></script>
    <script type="text/javascript">
        var $CONFIG = {};
        $CONFIG['a_host'] = 'http:\/\/cluster.kdnet.net';
        $CONFIG['a_format'] = 'json';
    </script>


    <script src="{{asset('/home/js/flexible .js')}}" tppabs="{{asset('/home/js/flexible .js')}}">
    </script>

    <script src="{{asset('/home/js/html5shiv.min.js')}}" tppabs="{{asset('/home/js/html5shiv.min.js')}}">
    </script>
    <script src="{{asset('/home/js/respond.min.js')}}" tppabs="{{asset('/home/js/respond.min.js')}}">
    </script>

    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/common.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/jquery.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/home.css')}}"/>

</head>

<body>


<div class="header-layout">
    <div class="header">
        <a class="kd-logo" href="index.htm" tppabs="http://www.kdnet.net/">
            <img src="{{asset('/home/img/logo.e2694c41.png')}}" tppabs="{{asset('/home/img/logo.e2694c41.png')}}"
            />
        </a>
        <ul class="moremenu-list">
            <li>
                <a href="javascript:;">
                    社区
                </a>
            </li>

        </ul>
        <div class="pull-right">
            <div class="search-wrap">
                <form class="search-form" action="http://search.kdnet.net/" target="_blank">
                    <input type="text" class="form-control" placeholder="" value="" name="q">
                    <button class="btn btn-default" type="submit">
                        <i class="fa fa-search">
                        </i>
                    </button>
                </form>
            </div>
            <ul class="nav navbar-nav login-nav">
                <li>
                    <a id="login" href="javascript:void(0);">
                        登录
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        注册
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="shortcut-wrap">
    <div class="shortcut">
        <div class="pull-left">
            <ul class="shortcut-list">
                <li>
                    <em>
                        社区快捷入口：
                    </em>
                </li>
                @foreach($plates as $k=>$v)
                    <li>
                        <a target="_blank" href="javascript:;">
                            {{$v->pname}}
                        </a>
                    </li>
                @endforeach
                <li class="hover" id="shortcut-show">
                    <a>
                        更多版块
                        <em class="fa fa-caret-down">
                        </em>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shortcut-right">
            <img src="{{asset('/home/img/slogan_2x.810e56d0.png')}}"
                 tppabs="{{asset('/home/img/slogan_2x.810e56d0.png')}}"
            />
        </div>
        <div class="shortcut-more" id="shortcut-more">
            @foreach($platess as $k=>$v)
                <dd>
                    <a target="_blank" href="javascript:;">
                        {{$v->pname}}
                    </a>
                </dd>
            @endforeach
        </div>
    </div>
</div>
<div class="layout">
    <div class="location">
        <div class="location-nav">
            <a>
                <script type="text/javascript">
                    ac_as_id = "mm_34021018_13540158_78462673";
                    ac_format = 1;
                    ac_mode = 1;
                    ac_group_id = 1;
                    ac_server_base_url = "afpeng.alimama.com/";
                </script>
                <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                </script>
            </a>
        </div>
    </div>
    <div class="c_spread">
        <script type="text/javascript">
            ac_as_id = "mm_34021018_13540158_78486697";
            ac_format = 1;
            ac_mode = 1;
            ac_group_id = 1;
            ac_server_base_url = "afpeng.alimama.com/";
        </script>

        {{--人以群分推荐位广告--}}
        <a href="#"> <img src=" {{$adspace[1]->adimg}}" alt=""></a>

        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
        </script>
    </div>
    <div class="topnews-box">
        <div class="topnews">
            <ul>
                @foreach($maxtwo as $k=>$v)
                    <li>
                        <img src="{{asset('/home/img/59dc6338e9938.png')}}"/>
                        <a target="_blank" href="javascript: ;">
                            <p class="topnews-title">
                                {{$v->title}}
                            </p>
                            <p class="topnews-content">
                                {{$v->content}}
                            </p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <a href="site/history.htm" tppabs="http://www.kdnet.net/site/history">
            以往头条
        </a>
    </div>


    {{--轮播器模块--}}
    <div class="mainbox">
        <div class="mainbox-left">

            <div class="layout-floor">
                <div class="flashbox">

                    <div id="divs">

                        <div id="myCarousel" class="carousel slide"  style="width:830px;">
                            <!-- 轮播（Carousel）指标 -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <!-- 轮播（Carousel）项目 -->
                            <div id="lunbotu" class="carousel-inner" style="width:830px;height:340px;">

                                @foreach($runimg as $k=>$v)
                                <div class="item" >
                                    <img src="{{$v->imgfile}}" alt="">
                                    {{--<p>--}}
                                        {{--{{$v->name}}--}}
                                    {{--</p>--}}
                                </div>
                                @endforeach
                            </div>
                            <!-- 轮播（Carousel）导航 -->
                            <a class="carousel-control left" href="#myCarousel"
                               data-slide="prev">&lsaquo;
                            </a>
                            <a class="carousel-control right" href="#myCarousel"
                               data-slide="next">&rsaquo;
                            </a>
                        </div>

                    </div>
                </div>

            </div>
            <script>
                $(document).ready(function(){
                    $('#myCarousel').carousel({interval:5000});//每隔5秒自动轮播
                });
                var div =  document.getElementById('lunbotu');
                //第一张图加上active属性值
                $('#lunbotu div:first-child').addClass('active');
            </script>



            {{--板块内容--}}
            <div class="layout-floor">
                <div class="indexlist">
                    @foreach($arr as $k => $v)
                        <div class="indexlist-box indexlist-box-read" id="showpost">
                            <div class="indexlist-box-title">
                                <a target="_blank" href="site/more-id=1.htm"
                                   tppabs="http://www.kdnet.net/site/more?id=1">
                                    {{$k}}
                                </a>
                            </div>
                            <ul>
                                @foreach($arr[$k] as $m=>$n)
                                    <li>
                                        <a class="title-read" href="javascript:;" target="_blank"
                                           title="{{$tagname[$n->tagid]}}”">
                                            {{$tagname[$n->tagid]}}
                                        </a>
                                        <a href="javascript:;" target="_blank">
                                            {{$n->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <style>
                #showpost {
                    margin-top: 10px;
                    height: 400px;
                }
            </style>
            <div class="c_spread">
                <script type="text/javascript">
                    ac_as_id = "mm_34021018_13540158_78482941";
                    ac_format = 1;
                    ac_mode = 1;
                    ac_group_id = 1;
                    ac_server_base_url = "afpeng.alimama.com/";
                </script>

                {{--爸爸不回家吃饭广告--}}
                <a href="#"><img src="{{$adspace[2]->adimg}}" alt=""></a>

                <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                </script>
            </div>
            <div class="layout-floor">
                <div class="indexpic">
                    <div class="indexpic-title">
                        <a target="_blank" href="javascript:;">
                            影像
                        </a>
                    </div>
                    <ul>
                        @foreach($plate as $k=>$v)
                            <li>
                                <a href="javascript:;">
                                    <img src="{{$v->imgfile}}"/>
                                    <p>
                                        {{$v->pname}}
                                    </p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="mainbox-right">
            <div class="layout-floor">
                <div class="mainbox-right-panel">
                    <dl>
                        <dt>
                            活动
                        </dt>
                        @foreach($huodong as $k=>$v)
                            <dd>
                                <a target="_blank" href="javascript:;" title="">
                                    {{$v->title}}
                                </a>
                            </dd>
                        @endforeach
                    </dl>
                    <ul>
                        <li>
                            <a target="_blank" href="javascript:;">
                                        <span class="ico-wb-bg">
                                            <i class="fa fa-weibo"></i>
                                        </span>
                                <p>凯迪官方微博</p>
                            </a>
                        </li>
                        <li>
                            <a class="j-follow-qrcode">
                                        <span class="ico-wx-bg">
                                            <i class="fa fa-weixin">
                                            </i>
                                        </span>
                                <p>
                                    凯迪微信公众号
                                </p>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="javascript:;">
                                        <span class="ico-app-bg">
                                            <i class="fa fa-mobile">
                                            </i>
                                        </span>
                                <p>
                                    凯迪客户端
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="layout-floor">
                <div class="indexside">
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78480992";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        {{--右侧欲知广告位--}}
                        <a href="#"><img src="{{$adspace[0]->adimg}}" alt=""></a>

                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"
                                tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                    <div class="indexside-box indexside-box-industry">
                        <div class="indexside-box-top">
                            原创作者推荐
                        </div>
                        <dl class="indexside-list3">
                            @foreach($auther as $k=>$v)
                                <dt>
                                    <a target="_blank" href="javascript:;">
                                        <img src="{{asset('/home/img/12417931.jpg-imageMogr2-crop-200x200.jpg')}}"
                                             tppabs="{{asset('/home/img/12417931.jpg-imageMogr2-crop-200x200.jpg')}}"
                                        />
                                    </a>
                                    <p class="indexside-title">
                                        <a target="_blank" href="javascript:;">
                                            {{$username[$v->uid]}}
                                        </a>
                                    </p>
                                    <p class="indexside-content">
                                        <a target="_blank" href="javascript:;">
                                            {{$v->title}}
                                        </a>
                                    </p>
                                </dt>
                            @endforeach
                        </dl>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78506062";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        {{--右侧男科广告位--}}
                        <a href="#"><img src="{{$adspace[4]->adimg}}" alt=""></a>

                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"
                                tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="friendslink">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#firends1" data-toggle="tab" aria-expanded="true">
                    友情链接
                </a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="firends1">

                @foreach($link as $k => $v)

                    <a href="{{$v->link}}">
                        {{$v->linkname}}
                    </a>

                @endforeach

            </div>
        </div>
    </div>
    <div class="c_spread">
        <script type="text/javascript">
            ac_as_id = "mm_34021018_13540158_78494272";
            ac_format = 1;
            ac_mode = 1;
            ac_group_id = 1;
            ac_server_base_url = "afpeng.alimama.com/";
        </script>
        {{--下方城市生活广告位--}}
        <a href="#"><img src="{{$adspace[3]->adimg}}" alt=""></a>

        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
        </script>
    </div>
</div>
<div class="footer-layout">
    <div class="footer">
        <div class="footer-slogan">
        </div>
        <div class="footer-links">
            <a target="_blank" href="javascript:;">
                关于凯迪
            </a>
            |
            <a target="_blank" href="javascript:;">
                联系我们
            </a>
            |
            <a target="_blank" href="javascript:;">
                广告服务
            </a>
            |
            <a target="_blank" href="javascript:;">
                法律声明
            </a>
            |
            <a target="_blank" href="javascript:;">
                加入凯迪
            </a>
        </div>
        <div class="copyright">
            <p class="copyright-link">
                <a target="_blank" href="javascript:;">
                    琼ICP备09005089号-1
                </a>
                |
                <a target="_blank" href="javascript:;">
                    琼公网安备 46010802000011号
                </a>
                |
                <a target="_blank" href="javascript:;">
                    增值电信业务经营许可证琼B2-20170044
                </a>
                |
                <a target="_blank" href="javascript:;">
                    网络文化经营许可证 琼网文（2017）5780-224号
                </a>
            </p>
            <p>
                违法和不良信息举报电话：12377 0898-68555596 举报邮箱：jubao@12377.cn 广州广告热线：020-87386049
            </p>
            <p>
                Copyright &copy;2017&nbsp;kdnet.net corporation. All Rights Reserved
            </p>
        </div>
        <div class="footer-app-download">
            <a target="_blank" href="javascript:;">
                <i class="fa fa-apple">
                </i>
                IOS客户端
            </a>
            <a target="_blank" href="javascript:;">
                <i class="fa fa-android">
                </i>
                Android客户端
            </a>
        </div>
        <div class="footer-follow">
            关注我们：
            <a class="j-follow-qrcode" href="javascript:void(0);">
                <i class="fa fa-weixin">
                </i>
            </a>
            <a href="javascript:;">
                <i class="fa fa-weibo">
                </i>
            </a>
        </div>
        <div class="footer-img">
            <a target="_blank" href="javascript:;">
                <img src="{{asset('/home/img/ip.a8d1a336.png')}}" tppabs="{{asset('/home/img/ip.a8d1a336.png')}}"
                />
            </a>
            <a target="_blank" href="javascript:;">
                <img src="{{asset('/home/img/icp.2aefced4.png')}}" tppabs="{{asset('/home/img/icp.2aefced4.png')}}"
                />
            </a>
            <a target="_blank" href="javascript:;">
                <img src="{{asset('/home/img/cnnic.9ef031ec.png')}}" tppabs="{{asset('/home/img/cnnic.9ef031ec.png')}}"
                />
            </a>
            <a target="_blank" href="javascript:;">
                <img src="{{asset('/home/img/ir.27ae3c5e.png')}}" tppabs="{{asset('/home/img/ir.27ae3c5e.png')}}"
                />
            </a>
            <a target="_blank" href="javascript:;">
                <img src="{{asset('/home/img/ir_b.120a6368.png')}}" tppabs="{{asset('/home/img/ir_b.120a6368.png')}}"
                />
            </a>
            <a target="_blank" href="javascript:;">
                <img src="{{asset('/home/img/logo-weiyun.0f3660d4.png')}}"
                     tppabs="{{asset('/home/img/logo-weiyun.0f3660d4.png')}}"
                />
            </a>
        </div>
    </div>
</div>
<div class="popover-mask">
</div>
<div class="popover-qrcode">
    <p>
        关注我们的微信公众号，发现信息价值。
        <br>
        微信中搜索
        <strong class="text-primary">
            「凯迪」
        </strong>
        或扫一扫下方二维码：
    </p>
    <img src="{{asset('/home/img/kd_wechat_qrcode.d05c21e8.png')}}"
         tppabs="{{asset('/home/img/kd_wechat_qrcode.d05c21e8.png')}}"
    />
</div>
<script>
    ac_as_id = "mm_34021018_13540158_54576826";
    ac_format = 2;
    ac_mode = 1;
    ac_group_id = 1;
    ac_server_base_url = "afpeng.alimama.com/";
</script>
<script src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
</script>

 </body>


<script type="text/javascript" src="{{asset('/home/js/common.js')}}" tppabs="{{asset('/home/js/common.js')}}">
</script>
<script type="text/javascript" src="{{asset('/home/js/log.js')}}" tppabs="{{asset('/home/js/log.js')}}">
</script>
<script type="text/javascript" src="{{asset('/home/js/home.js')}}" tppabs="{{asset('/home/js/home.js')}}">
</script>
<script type="text/javascript" src="{{asset('/home/js/hindex.js')}}" tppabs="{{asset('/home/js/hindex.js')}}">
</script>

</html>