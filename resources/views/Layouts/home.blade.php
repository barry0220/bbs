<!DOCTYPE html>
<html lang="zh-CN">
    
    <head>
        <meta charset=gbk "utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <meta property="qc:admins" content="15033067352456645346346546654" />
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @yield("title")
        </title>
        <meta name="author" content="凯迪网络">
        <meta name="keywords" content="凯迪,社区,凯迪网络,凯迪社区,深水区,猫眼看人,政经,思想,媒体,公共观察,舆情观察">
        <meta name="description" content="凯迪网络（www.kdnet.net），伴随中国互联网和网民共同成长，从中国第一代网络论坛发轫，凯迪以“客观、公正、理性、宽容”为宗旨，聚集了一千多万中高端注册用户，已发展成为中国最具代表性的互联网UGC （用户生成内容）平台之一，其中“猫眼看人”版块至今已连续十年在全国所有社区论坛版块中排名第一。凯迪网络全面启动新战略：专注于文化、财经、社会内容，面向互联网年轻一代打造新型服务。">
        <meta name="copyright" content="凯迪网络版权所有" />
        <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"
        />
        <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"
        />
        <script type="text/javascript">
            var $CONFIG = {};
            $CONFIG['a_host'] = 'http:\/\/cluster.kdnet.net';
            $CONFIG['a_format'] = 'json';
        </script>
        <script type="text/javascript">
            !
            function(a, b) {
                if (!b.__SV) {
                    var c, d, e, f;
                    window.dplus = b,
                    b._i = [],
                    b.init = function(a, c, d) {
                        function g(a, b) {
                            var c = b.split(".");
                            2 == c.length && (a = a[c[0]], b = c[1]),
                            a[b] = function() {
                                a.push([b].concat(Array.prototype.slice.call(arguments, 0)))
                            }
                        }
                        var h = b;
                        for ("undefined" != typeof d ? h = b[d] = [] : d = "dplus", h.people = h.people || [], h.toString = function(a) {
                            var b = "dplus";
                            return "dplus" !== d && (b += "." + d),
                            a || (b += " (stub)"),
                            b
                        },
                        h.people.toString = function() {
                            return h.toString(1) + ".people (stub)"
                        },
                        e = "disable track track_links track_forms register unregister get_property identify clear set_config get_config get_distinct_id track_pageview register_once track_with_tag time_event people.set people.unset people.delete_user".split(" "), f = 0; f < e.length; f++) g(h, e[f]);
                        b._i.push([a, c, d])
                    },
                    b.__SV = 1.1,
                    c = a.createElement("script"),
                    c.type = "text/javascript",
                    c.charset = "utf-8",
                    c.async = !0,
                    c.src = "../w.cnzz.com/dplus.php-id=1260004087"
                    /*tpa=http://w.cnzz.com/dplus.php?id=1260004087*/
                    ,
                    d = a.getElementsByTagName("script")[0],
                    d.parentNode.insertBefore(c, d)
                }
            } (document, window.dplus || []),
            dplus.init("1260004087");
        </script>
        <!--[if gte IE 9]>
            <script src="../qc-static.kdnet.net/static/static/common/libs/flexible/flexible.9cef59ac.js"
            tppabs="http://qc-static.kdnet.net/static/static/common/libs/flexible/flexible.9cef59ac.js">
            </script>
        <![endif]-->
        <!--[if lt IE 9]>
            <script src="../qc-static.kdnet.net/static/static/common/js/html5shiv.min.831d9bca.js"
            tppabs="http://qc-static.kdnet.net/static/static/common/js/html5shiv.min.831d9bca.js">
            </script>
            <script src="../qc-static.kdnet.net/static/static/common/js/respond.min.39981a39.js"
            tppabs="http://qc-static.kdnet.net/static/static/common/js/respond.min.39981a39.js">
            </script>
        <![endif]-->
        <script type="text/javascript">
            _atrk_opts = {
                atrk_acct: "qlI7j1a4ZP00wT",
                domain: "http://club.kdnet.net/kdnet.net",
                dynamic: true
            }; (function() {
                var as = document.createElement('script');
                as.type = 'text/javascript';
                as.async = true;
                as.src = "{{asset('/home/js/atrk.js')}}";
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(as, s);
            })();
            // "../d31qbv1cthcecs.cloudfront.nettrk.js"
            
        </script>
        <noscript>
            <img src="../d5nxst8fruw4z.cloudfront.net/atrk.gif-account=qlI7j1a4ZP00wT.gif"
            tppabs="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=qlI7j1a4ZP00wT"
            style="display:none" height="1" width="1" alt="" />
        </noscript>
        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/common.css')}}"
        tppabs="{{asset('/home/css/common.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/jquery.webui-popover.css')}}"
        tppabs="{{asset('/home/css/jquery.webui-popover.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/bbs.css')}}"
        tppabs="{{asset('/home/css/bbs.8d80e54e.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/home/css/bbsWidget.css')}}"
        tppabs="{{asset('/home/css/bbsWidget.css')}}" />
    </head>
    
    <body>
        <div class="bbsheader">
            <div class="bbsCont">
                <ul class="topnav">
                    <li>
                        <a href="{{url('/home/index')}}" tppabs="http://www.kdnet.net/">
                            首页
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/home/post')}}" tppabs="http://club.kdnet.net/">
                            社区
                        </a>
                    </li>
                </ul>
                <div class="rightnav">
                    <div class="search-box">
                        <form class="search-form" action="http://search.kdnet.net/" target="_blank">
                            <input type="text" class="form-control" placeholder="" value="" name="q">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search">
                                </i>
                            </button>
                        </form>
                    </div>
                    <div class="login-box">
                        <a id="login" href="javascript:;">
                            登录
                        </a>
                        <a id="reg" href="javascript:;">
                            注册
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bbsindex">
            <div class="bbsnav">
                <div class="bbsCont">
                    <div class="bbs-logo">
                        <a href="index.htm" tppabs="http://club.kdnet.net/">
                            <img src="{{asset('/home/img/bbs_logo.9d4c4827.png')}}" tppabs="http:public/home/img/bbs_logo.9d4c4827.png">
                        </a>
                    </div>
                    <ul>
                    @foreach($tags as $k => $v)
                        <li>
                            <a target="_blank" href="{{url('/home/list/'.$v->id)}}"
                            tppabs="http://hot.kdnet.net/hottopiclist.asp">
                                {{$v->tagname}}
                            </a>
                        </li>
                    @endforeach
                       
                    </ul>
                    <div class="bbsdata">
                        <i>
                        </i>
                        注册用户
                        <span class="text-info">
                            14305392
                        </span>
                        人，目前在线
                        <span class="text-warning">
                            151651
                        </span>
                        人
                    </div>
                </div>
            </div>

    @section("content")



        @show
          <div class="bbsRight">
                    <div id="myCarousel" class="excellent carousel slide">
                        <div class="title">
                            优秀作者

                        </div>
                        <div class="carousel-inner">
                            <div class="active item" data-slide="1">
                                <ul>
                                    @foreach($author as $k=>$v)
                                    <li>
                                        <div class=" a-w40">
                                            <a target="_blank" href="#"
                                            tppabs="http://user.kdnet.net/index.asp?userid=12417931">
                                                <img src="{{asset('/home/img/12417931.jpg-imageMogr2-crop-200x200.jpg')}}"
                                                tppabs="{{asset('/home/img/12417931.jpg-imageMogr2-crop-200x200.jpg')}}"
                                                onerror="this.src='http://qc-cache.kdnet.net/Images/userface/image41.gif?imageMogr2/crop/200x200'">
                                            </a>
                                        </div>
                                        <div class="area">
                                            <h5>
                                                <a target="_blank" href="{{url('home/post/'.$v->id)}}" tppabs="http://club.kdnet.net/dispbbs.asp?id=12447465">
                                                   {{$v->title}}
                                                </a>
                                            </h5>
                                            <h6>
                                                <a target="_blank" href="">
                                                    {{$postusers[$v->uid]}}
                                                </a>
                                            </h6>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78530481";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                    
                    <div class="bbsad">
                        <a href="javascript:if(confirm('http://m.kdnet.net/intro/mobile.html  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://m.kdnet.net/intro/mobile.html'"
                        tppabs="http://m.kdnet.net/intro/mobile.html">
                            <img src="{{asset('/home/img/ad-bbs-r2.cadbced4.png')}}" tppabs="{{asset('/home/img/ad-bbs-r2.cadbced4.png')}}">
                        </a>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78530484";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bbsfooter">
            <div class="bbsCont">
                <p class="links">
                    友情链接：
                    <a href="javascript:if(confirm('http://wpa.qq.com/msgrd?uin=3231583911&site=qq  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://wpa.qq.com/msgrd?uin=3231583911&site=qq'"
                    tppabs="http://wpa.qq.com/msgrd?uin=3231583911&site=qq" target="_blank">
                        购买链接
                    </a>
                    <a href="javascript:if(confirm('http://youshengbb.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://youshengbb.com/'"
                    tppabs="http://youshengbb.com/" target="_blank">
                        生男孩的科学方法
                    </a>
                    <a href="javascript:if(confirm('http://www.judazhe.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.judazhe.com/'"
                    tppabs="http://www.judazhe.com/" target="_blank">
                        巨打折特卖
                    </a>
                    <a href="javascript:if(confirm('http://www.gdqynews.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.gdqynews.com/'"
                    tppabs="http://www.gdqynews.com/" target="_blank">
                        清远新闻
                    </a>
                    <a href="javascript:if(confirm('http://news.shangol.cn/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://news.shangol.cn/'"
                    tppabs="http://news.shangol.cn/" target="_blank">
                        商洛新闻
                    </a>
                    <a href="javascript:if(confirm('http://www.fm19.cn/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.fm19.cn/'"
                    tppabs="http://www.fm19.cn/" target="_blank">
                        高仿手表
                    </a>
                    <a href="javascript:if(confirm('http://www.86daigou.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.86daigou.com/'"
                    tppabs="http://www.86daigou.com/" target="_blank">
                        代购
                    </a>
                    <a href="javascript:if(confirm('http://www.yungold.cn/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.yungold.cn/'"
                    tppabs="http://www.yungold.cn/" target="_blank">
                        今日黄金价格
                    </a>
                    <a href="javascript:if(confirm('http://www.dyqp.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.dyqp.com/'"
                    tppabs="http://www.dyqp.com/" target="_blank">
                        棋牌游戏
                    </a>
                    <a href="javascript:if(confirm('http://ielts.zhan.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://ielts.zhan.com/'"
                    tppabs="http://ielts.zhan.com/" target="_blank">
                        雅思培训
                    </a>
                    <a href="javascript:if(confirm('http://wap.gaoren.net/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://wap.gaoren.net/'"
                    tppabs="http://wap.gaoren.net/" target="_blank">
                        算命婚姻
                    </a>
                    <a href="javascript:if(confirm('http://www.9kus.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.9kus.com/'"
                    tppabs="http://www.9kus.com/" target="_blank">
                        九库文学网
                    </a>
                    <a href="javascript:if(confirm('http://www.sofanyong.cn/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.sofanyong.cn/'"
                    tppabs="http://www.sofanyong.cn/" target="_blank">
                        返佣网
                    </a>
                    <a href="javascript:if(confirm('http://www.sanguogame.com.cn/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.sanguogame.com.cn/'"
                    tppabs="http://www.sanguogame.com.cn/" target="_blank">
                        三国游戏
                    </a>
                    <a href="javascript:if(confirm('http://www.jianzhiwangzhan.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.jianzhiwangzhan.com/'"
                    tppabs="http://www.jianzhiwangzhan.com/" target="_blank">
                        网上兼职
                    </a>
                    <a href="javascript:if(confirm('http://www.gougoujp.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.gougoujp.com/'"
                    tppabs="http://www.gougoujp.com/" target="_blank">
                        雅虎日本
                    </a>
                    <a href="javascript:if(confirm('http://www.haohead.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.haohead.com/'"
                    tppabs="http://www.haohead.com/" target="_blank">
                        vi设计公司
                    </a>
                    <a href="javascript:if(confirm('http://www.okgcw.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.okgcw.com/'"
                    tppabs="http://www.okgcw.com/" target="_blank">
                        广场舞
                    </a>
                    <a href="javascript:if(confirm('http://www.csyestar.com/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.csyestar.com/'"
                    tppabs="http://www.csyestar.com/" target="_blank">
                        长沙整形医院
                    </a>
                    <a href="javascript:if(confirm('http://www.haoqkl.cn/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.haoqkl.cn/'"
                    tppabs="http://www.haoqkl.cn/" target="_blank">
                        区块链
                    </a>
                    <a href="javascript:if(confirm('http://www.join5.cn/  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.join5.cn/'"
                    tppabs="http://www.join5.cn/" target="_blank">
                        餐饮加盟
                    </a>
                </p>
                <p class="state">
                    本站律师声明：本站互动区域原创内容版权属作者和本站共同所有。
                    <br/>
                    网络非盈利转载须注明作者姓名和文章的来源出处，其他媒体利用除注明作者姓名和文章的来源出处外还须按规定付酬。侵权必究。
                    <br/>
                    法律顾问：广信君达律师事务所 刘东栓 赵广群律师
                </p>
                <div class="copyright">
                    Copyright &copy;2017
                    <a target="_blank" href="../www.kdnet.net/index.htm" tppabs="http://www.kdnet.net/">
                        kdnet.net
                    </a>
                    corporation.
                    <i>
                        All Rights Reserved
                    </i>
                    <p class="copy-link">
                        <a target="_blank" href="javascript:if(confirm('http://about.kdnet.net/brief.php  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://about.kdnet.net/brief.php'"
                        tppabs="http://about.kdnet.net/brief.php">
                            关于凯迪
                        </a>
                        |
                        <a target="_blank" href="../about.kdnet.net/join.php" tppabs="http://about.kdnet.net/join.php">
                            联系我们
                        </a>
                        |
                        <a target="_blank" href="../about.kdnet.net/join.php" tppabs="http://about.kdnet.net/join.php">
                            广告服务
                        </a>
                        |
                        <a target="_blank" href="../about.kdnet.net/copyright.php" tppabs="http://about.kdnet.net/copyright.php">
                            法律声明
                        </a>
                        |
                        <a target="_blank" href="../about.kdnet.net/join-us.php" tppabs="http://about.kdnet.net/join-us.php">
                            加入凯迪
                        </a>
                    </p>
                </div>
                <p class="app-download-btn">
                    <a class="btn btn-default" href="javascript:if(confirm('https://itunes.apple.com/us/app/id422816553?mt=8  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='https://itunes.apple.com/us/app/id422816553?mt=8'"
                    tppabs="https://itunes.apple.com/us/app/id422816553?mt=8" target="_blank">
                        <i class="fa fa-apple">
                        </i>
                        iOS客户端
                    </a>
                    <a class="btn btn-default" href="javascript:if(confirm('http://m.kdnet.net/app/newest/url/a  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://m.kdnet.net/app/newest/url/a'"
                    tppabs="http://m.kdnet.net/app/newest/url/a" target="_blank">
                        <i class="fa fa-android">
                        </i>
                        Android客户端
                    </a>
                </p>
                <p class="follow-info">
                    关注我们：
                    <a class="j-follow-qrcode" href="javascript:void(0);">
                        <i class="fa fa-weixin">
                        </i>
                    </a>
                    <a href="javascript:if(confirm('http://www.weibo.com/p/1002061744259092  \n\n该文件无法用 Teleport Ultra 下载, 因为 它是一个域或路径外部被设置为它的启始地址的地址。  \n\n你想在服务器上打开它?'))window.location='http://www.weibo.com/p/1002061744259092'"
                    tppabs="http://www.weibo.com/p/1002061744259092" target="_blank">
                        <i class="fa fa-weibo">
                        </i>
                    </a>
                    </a>
                </p>
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
            <img src="{{asset('/home/img/kd_wechat_qrcode.d05c21e8.png')}}" tppabs="{{asset('/home/img/kd_wechat_qrcode.d05c21e8.png')}}"
            />
        </div>
        <script>
            ac_as_id = "mm_34021018_13540158_54576827";
            ac_format = 2;
            ac_mode = 1;
            ac_group_id = 1;
            ac_server_base_url = "afpeng.alimama.com/";
        </script>
        <script src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
        </script>
    </body>
    <script type="text/javascript" src="{{asset('/home/js/common.js')}}"
    tppabs="{{asset('/home/js/common.js')}}">
    </script>
    <script type="text/javascript" src="{{asset('/home/js/log.js')}}" tppabs="{{asset('/home/js/log.js')}}">
    </script>
    <script type="text/javascript" src="{{asset('/home/js/bbs.js')}}"
    tppabs="{{asset('/home/js/bbs.js')}}">
    </script>
    <script type="text/javascript" src="{{asset('/home/js/bbsindex.js')}}"
    tppabs="{{asset('/home/js/bbsindex.js')}}">
    </script>

    <script type="text/javascript">
        !
        function() {
            if (location.host == 'http://club.kdnet.net/uc.kdnet.net') {
                var _hmt_keys = "4584ffe9d9787c63971dee1a706a9df8";
            } else {
                var _hmt_keys = "86996f749ffad4ce6ea9c7b1ca3a0a77";
            }
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?" + _hmt_keys;
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        } (); !
        function() {
            if ($.isFunction(window.tracking_log)) {
                var tracking_starttime = 1507623557;
                tracking_log();
            }

        } (); !
        function() {
            require("bbs:widget/bbsheader/bbsheader.js").init();
        } (); !
        function() {
            require('bbs:widget/pager/pager.js').init(38);

        } (); !
        function() {
            require("bbs:widget/bbscarousel/bbscarousel.js").init();
        } (); !
        function() {
            require("bbs:widget/bbssellgroup/bbssellgroup.js").init();
        } (); !
        function() {
            require("bbs:widget/bbsfooter/bbsfooter.js").init();
        } (); !
        function() {
            require("bbs:static/util/bbsindex.js").init('c1-1');
        } ();
    </script>

</html>