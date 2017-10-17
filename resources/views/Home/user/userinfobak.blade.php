<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>个人信息设置</title>
    <meta name="author" content="凯迪网络">
    <meta name="keywords" content="个人用户中心,凯迪网络">
    <meta name="description" content="凯迪网络个人用户中心">
    <meta name="copyright" content="凯迪网络版权所有">
    <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link rel="bookmark" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon">
    <link href="{{asset('/home/css/base4_22.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/face.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/user.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/home/css/user2-0923.css')}}" rel="stylesheet" type="text/css">
    <!-- sunny modify 20130902 积分 -->
    <script type="text/javascript" async="" src="{{asset('home/js/jquery-1.4.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/jquery.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/jquery.jm.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/valid.js')}}"></script>
    <!--script type="text/javascript" src="http://panda.kdnet.net/scripts/log.js"></script-->
    <script type="text/javascript">
        var cf;
        var cfw;
        var user = {
                id: 15945881,
                name: "barry0220",
                status: true
            },
            KDNET_USER_URL = "fat.com";
        var userid = 15945881;
        var username = '我';
        var duf = 'http://imgcdn.cat898.com/upload/userface/NoPic.jpg';
        var duf_190_190 = 'http://imgcdn.cat898.com/upload/userface/NoPic_190_190.jpg';
        var duf_60_60 = 'http://imgcdn.cat898.com/upload/userface/NoPic_60_60.jpg';
        var duf_40_40 = 'http://imgcdn.cat898.com/upload/userface/NoPic_40_40.jpg';

        //关注、推荐tabs切换
        function Tabs_active(obj) {
            var o = document.getElementById('followactnav');
            var c = o.childNodes;
            var n = 0;
            for (var i = 0,
                     j = 1; i < c.length; i++, j++) {
                var str = "myfollowact_" + j;
                if (c[i] == obj) {
                    c[i].id = "fon";
                    document.getElementById(str).style.display = "block";
                } else {
                    document.getElementById(str).style.display = "none";
                    c[i].id = "";
                }
            }
        }

        //文集、跟贴、微评tabs切换
        function Tabs_active2(obj) {
            var o = document.getElementById('tnav');
            var c = o.childNodes;
            var n = 0;
            for (var i = 0,
                     j = 1; i < c.length; i++, j++) {
                var str = "Active_cont_" + j;
                if (c[i] == obj) {
                    c[i].id = "ton";
                    document.getElementById(str).style.display = "block";
                } else {
                    document.getElementById(str).style.display = "none";
                    c[i].id = "";
                }
            }
        }

        function openLoginPopup() {
            $.openPopupLayer({
                name: "LoginPopup",
                width: 880,
                target: "hidden_frame",
                success: function() //{$('#popupLayer_LoginPopup').children('#_frame').attr('src','http://user.kdnet.net/login.asp?suserid=&token=&ts=&sina_name=&sina_location=&sina_url=&sina_gender=&r='+(new Date()).getTime());}
                {
                    $('#popupLayer_LoginPopup').children('#_frame').attr('src', 'http://user.kdnet.net/login_new2.asp?suserid=&token=&ts=&sina_name=&sina_location=&sina_url=&sina_gender=&r=' + (new Date()).getTime());
                }

            });
        }
        function openRegisterPopup() {
            $.openPopupLayer({
                name: "RegisterPopup",
                width: 628,
                target: "hidden_frame",
                //success: function() {$('#popupLayer_RegisterPopup').children('#_frame').attr('src','http://user.kdnet.net/register.asp?invite=');}
                success: function() {
                    $('#popupLayer_RegisterPopup').children('#_frame').attr('src', 'http://user.kdnet.net/register_new2.asp?invite=');
                }
            });
        }
        function openItemPopup() {
            $.openPopupLayer({
                name: "ItemPopup",
                width: 700,
                target: "hidden_frame",
                success: function() {
                    $('#popupLayer_ItemPopup').children('#_frame').attr('src', 'http://user.kdnet.net/item.asp');
                }
            });
        }
        function openForgetPopup() {
            $.openPopupLayer({
                name: "ForgetPopup",
                width: 628,
                target: "hidden_frame",
                success: function() {
                    $('#popupLayer_ForgetPopup').children('#_frame').attr('src', 'http://user.kdnet.net/forget.asp');
                }
            });
        }

        var __uid = 0;
        var __from = 0;
        var triggers;

        function delFollowModal(el, userid) {
            __from = el.className;
            $("#sure_modal .info-cont-text").html("您确定要取消对此人的关注？");
            $("#sure_modal .btn-info").show();
            __uid = userid;
            triggers = $(el).overlay({
                mask: {
                    color: '#000',
                    loadSpeed: 200,
                    opacity: 0.5
                },
                top: 'center',
                load: true,
                closeOnClick: false
            });
        }

        $('document').ready(function() {
            var buttons = $("#sure_modal .ok").click(function(e) {
                delFollow();
            });
            $('.more-show').hide();
            $('.detailed-more-cont').fadeIn();
        });

        function delFollow() {
            $.ajax({
                url: "http://user.kdnet.net/follow.asp",
                type: "GET",
                data: 'a=del&uid=' + 15945881 + '&puid=' + __uid,
                cache: false,
                beforeSend: function() {
                    $("#sure_modal .info-cont-text").html(" 正在取消关注...请稍候！");
                    $("#sure_modal .btn-info").hide();
                },
                error: function() {
                    $("#sure_modal .info-cont-text").html(" 取消关注失败...点确定重试...");
                    $("#sure_modal .btn-info").show();
                },
                success: function(html) {
                    if (html.search("success") == -1) {
                        $("#sure_modal .info-cont-text").html(" 取消关注失败...点确定重试...");
                        $("#sure_modal .btn-info").show();
                    } else {
                        $("#sure_modal .info-cont-text").html(" 已经取消了此关注！");
                        window.setTimeout(function() {
                                triggers.overlay().close();
                            },
                            500);
                        window.setTimeout(function() {
                                c_frame.$('#follow_status_' + __uid).html('<a rel="#add_follow_modal" href="javascript:;" onclick="parent.addFollowModal(this,' + __uid + ');" class="addAttention 2" title="立即关注">立即关注</a>');
                            },
                            1200);
                        $('#follow_status_' + __uid).attr('className', 'btn-addfollow');
                        $('#follow_status_' + __uid).html('<a rel="#add_follow_modal" class="0" href="javascript:;" onclick="addFollowModal(this,' + __uid + ');" title="关注此用户">加关注</a>');

                    }
                }
            });
        }

        // 更多版块top控制
        var positions = 55;

        $(document).ready(function() {
            $(".loading").remove();
            $("#login_area").fadeIn();

            $('title').overlay({
                top: positions,
                fixed: false,
                target: '#overlay',
                load: false,
                onBeforeLoad: function() {
                    var wrap = this.getOverlay().find(".contentWrap");
                    wrap.load('clubforum.asp');
                },
                onLoad: function() {
                    $("#MoreForum").attr('className', 'moreforum-down');
                },
                onClose: function() {
                    $("#MoreForum").attr('className', 'moreforum-up');
                }
            });
            $('#more_btn').click(function() {
                if ($("title").overlay().isOpened()) {
                    $("title").overlay().close();
                } else {
                    $("title").overlay().load();
                }
            });
        });

        //-->

    </script>
    <script type="text/javascript" src="{{asset('/home/js/kd.user.js')}}"></script>
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
<div style="width:310px; margin:10px auto; display:none;" id="sure_modal">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="popuplayerinfo">
        <tbody>
        <tr>
            <td class="tl">
            </td>
            <td height="10" class="tc">
            </td>
            <td class="tr">
            </td>
        </tr>
        <tr>
            <td class="lc">
            </td>
            <td class="cc" valign="top" bgcolor="#f0f3f5">
                <div class="title-info clearfix">
                    <div class=" f14px fB">
                        提示信息
                    </div>
                    <div class="close-info">
                        <a href="javascript:;" class="close" title="关闭">
                            关闭
                        </a>
                    </div>
                </div>
                <div class="info-cont clearfix">
                    <div class="info-cont-icon">
                    </div>
                    <div class="info-cont-text">
                    </div>
                </div>
                <div class="btn-info">
                    <div class="clearfix">
                        <a href="javascript:;" class="ok">确定</a>
                        <a href="javascript:;" class="close" title="取消">取消</a>
                    </div>
                </div>
            </td>
            <td class="rc">
            </td>
        </tr>
        <tr>
            <td class="bl">
            </td>
            <td height="10" class="bc">
            </td>
            <td class="br">
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div id="hidden_frame" style="display:none;">

    asdasdasdasdasd
</div>
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
            <div class="logo" title="凯迪网络 主流声音">
                <a href="http://www.kdnet.net/">
                    凯迪网络 主流声音
                </a>
            </div>
            <div class="rf">
                <div class="globalnav c-sub">
                    社区版块：
                    <a target="_blank" href="http://club.kdnet.net/list.asp?boardid=1">猫眼看人</a>|
                    <a target="_blank" href="http://club.kdnet.net/list.asp?boardid=3">经济风云</a>|
                    <span id="MoreForum" class="moreforum-up">
                        <a href="javascript:;" id="more_btn">更多版块&nbsp;&nbsp;&nbsp;</a>
                    </span>
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
        <div class="num-info c-white">
            <span class="leader fB">14305441</span>位注册用户，目前在线
            <span class="fB" style="color:#223B4D;">122989</span>人，
        </div>
        <div class="login-info">
            欢迎你&nbsp;
            <span class="c-main">
                <a href="http://user.kdnet.net/index.asp">barry0220</a>
            </span>
            &nbsp;
            <span class="c-main">
                <a href="http://user.kdnet.net/index.asp">个人中心</a>
            </span>
            &nbsp;
            <!--<span class="c-main">
            <a href="javascript:;" onclick="KD.user.goto('sms',this);return false;">收件箱(0)</a>
            </span>&nbsp;-->
            <span class="fB c-main">
                <a href="http://user.kdnet.net/user.asp?a=logout" title="退出">退出</a>
            </span>
        </div>
        <div class="globalsearch">
            <div class="search-text">搜索：</div>
            <input name="q" type="text" id="s"  value="">
            <input type="submit" name="sa" id="searchsubmit" value="搜索" >
        </div>
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
                        <!-- a href="javascript:;" onclick="KD.user.goto('face',this);return false;">修改头像</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=face">
                            修改头像
                        </a>
                    </div>
                    <a href="http://user.kdnet.net/index.asp?userid=15945881">
                        <!--?userid=15945881-->
                        <span></span>
                        <img id="userface_img_index" onerror="this.src = duf_190_190;" src="{{asset('/home/img/saved_resource')}}"
                             width="70" height="70">
                    </a>
                </div>
                <div class="useridinfo">
                    <div class="userid clearfix">
                        <a href="http://user.kdnet.net/index.asp">
                            barry0220
                        </a>
                        <!--身份认证-->
                        <!--手机认证-->
                        <a href="javascript:;" target="_blank">
                            <img class="phone-icon" title="手机绑定用户" src="{{asset('/home/img/transparent.gif')}}">
                        </a>
                        <a href="javascript:;" onmouseover="" onmouseout="UnTip()">
                            <img class="lv1-icon" title="影响力" src="{{asset('/home/img/transparent.gif')}}">
                        </a>
                    </div>
                    <div class="c-main">
                        <!-- a href="javascript:;" onclick="KD.user.goto('setting',this);return
                        false;">修改资料</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=setting">
                            修改资料
                        </a>
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
                    <a href="http://user.kdnet.net/index.asp?Redirect=topic">
                        <strong>1</strong>
                        <span>主帖</span>
                    </a>
                </li>
                <li>
                    <a href="http://user.kdnet.net/index.asp?Redirect=fans">
                        <strong>0</strong>
                        <span>粉丝</span>
                    </a>
                </li>
                <li class="no-line">
                    <a href="http://user.kdnet.net/index.asp?Redirect=follow">
                        <strong>0</strong>
                        <span>关注</span>
                    </a>
                </li>
            </ul>
            <!--关注按钮-->
            <!--//关注按钮-->
            <div class="ad-xz-l clearfix">
                <a href="http://user.kdnet.net/index.asp?Redirect=honors">
                    <img src="{{asset('/home/img/ad_p1.png')}}" width="18" height="18">
                </a>
                <a href="javascript:;" >
                    <img src="{{asset('/home/img/ad_p2.png')}}" width="18" height="18">
                </a>
            </div>
            <div class="detailed clearfix">
                <!--<div class="detailed-info underline">积分：<a href="javascript:;" onclick="KD.user.goto('integrallog',this);return false;">0</a></div> sunny 20131213 integral-->
                <div class="detailed-info">
                    积分：
                    <a href="javascript:;">积分数量</a>
                </div>
                <!-- sunny 20131213 integral -->
            </div>
            <!-- sunny 20131106 lottery B -->
            <!-- sunny 打赏 B -->
            <div class="detailed clearfix">
                <div class="detailed-info" style="color:red">我的钱包</div>
                <div class="operating c-main">
                    <a href="https://qianbao.kdnet.net/" target="_blank">查询</a>
                </div>
            </div>
            <!-- sunny 打赏 E -->
            <!-- modify sunny group purchase B -->
            <div class="detailed clearfix">
                <div class="detailed-info">我的订单</div>
                <div class="operating c-main">
                    <!--<a href="http://mall.kdnet.net/orders.php" target="_blank">查询</a>-->
                    <a href="javascript:;">查询</a>
                </div>
            </div>
            <!-- modify sunny group purchase E -->
            <!-- sunny 20131106 lottery E -->
            <!-- 更多信息 -->
            <div class="more-show c-main" style="display: none;">
                <a href="javascript:;">更多信息</a>
            </div>
            <div class="detailed-more-cont" style="display: block;">
                <div class="detailed clearfix">
                    <div class="detailed-info">
                        Email：<a title=""></a>
                    </div>
                    <div class="operating c-main">
                        <a href="javascript:;" >验证</a>
                    </div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">手机：15269189983</div>
                    <div class="operating c-main">
                        <a href="javascript:;" >换号</a>
                    </div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">帐号绑定： 还没有绑定.</div>
                    <div class="operating c-main">
                        <a href="javascript:;" >绑定</a>
                        <!--未绑定</div>
                        <div class="operating c-main"><a href="javascript:;" onclick="KD.user.goto('bindAccount',this);return false;">绑定</a>-->
                    </div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">注册时间：2017/9/20 15:59</div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">上次登录：2017/10/10 18:47</div>
                </div>
                <div class="detailed clearfix">
                    <div class="detailed-info">登录次数：4</div>
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
            <!--添加关注modal-->
            <div class="info-boder" id="add_follow_modal" style="display:none;width:330px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="popuplayerinfo">
                    <tbody>
                    <tr>
                        <td class="tl"></td>
                        <td height="10" class="tc"></td>
                        <td class="tr"></td>
                    </tr>
                    <tr>
                        <td class="lc">
                        </td>
                        <td class="cc" valign="top" bgcolor="#f0f3f5">
                            <div class="title-info clearfix">
                                <div class="f14px fB"><!--请输入下面的验证码-->确认是否关注?</div>
                                <div class="close-info">
                                    <a href="javascript:;" class="close" title="关闭">关闭</a>
                                </div>
                            </div>
                            <div class="btn-info">
                                <div class="clearfix">
                                    <a href="javascript:;" class="ok">确定</a>
                                    <a href="javascript:;" class="close" title="取消">取消</a>
                                </div>
                            </div>
                        </td>
                        <td class="rc"></td>
                    </tr>
                    <tr>
                        <td class="bl"></td>
                        <td height="10" class="bc"></td>
                        <td class="br"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--添加关注modal End-->
            <script type="text/javascript">
                    function updateCodeImage(img) {
                        document.getElementById(img).src = "http://user.kdnet.net/DV_getcode.asp?time=" + new Date().getTime();
                    }

                var triggers;
                function addFollowModal(el, userid) {
                    __from = el.className;
                    //updateCodeImage('follow_valid_image');
                    $("#add_follow_modal .popuplayertips").html("");
                    $("#add_follow_modal .btn-info").show();
                    __uid = userid;
                    triggers = $(el).overlay({
                        mask: {
                            color: '#000',
                            loadSpeed: 200,
                            opacity: 0.5
                        },
                        top: 'center',
                        load: true,
                        closeOnClick: false
                    });
                }

                $('document').ready(function() {
                    $("#add_follow_modal .ok").click(function(e) {
                        addFollow();
                    });
                });

                function addFollow() {
                    $.ajax({
                        url: "http://user.kdnet.net/follow.asp",
                        type: "GET",
                        data: 'a=add&uid=' + 15945881 + '&puid=' + __uid + '&CodeStr=' + $("input[name='codestr']").val(),
                        cache: false,
                        beforeSend: function() {
                            $("#add_follow_modal .popuplayertips").removeClass('c-alarm').html("正在添加关注...请稍候！");
                            $("#add_follow_modal .btn-info").hide();
                        },
                        error: function() {
                            updateCodeImage('follow_valid_image');
                            $("#add_follow_modal .popuplayertips").removeClass('c-alarm').html("添加关注失败...点确定重试...");
                            $("#add_follow_modal .btn-info").show();
                        },
                        success: function(html) {
                            if (html.search("success") == -1) {
                                //updateCodeImage('follow_valid_image');
                                $("#add_follow_modal .popuplayertips").addClass('c-alarm').html(html);
                                $("#add_follow_modal .btn-info").show();
                            } else {
                                $("#add_follow_modal .popuplayertips").removeClass('c-alarm').html("添加关注成功！");
                                triggers.overlay().close();
                                var cls = 'btn-alreadyfollow';
                                if (__from == "addAttention 1") {
                                    $('#follow_status_' + __uid).attr('title', '已经关注此用户');
                                    $('#follow_status_' + __uid).html('<a class="disabled" title="已关注">已关注</a>');
                                } else if (__from == "addAttention") {
                                    cls = "alreadyfollow";
                                    //c_frame.$('#follow_status_' + __uid).attr('className',cls);
                                    c_frame.$('#follow_status_' + __uid).attr('title', '已经关注此用户');
                                    c_frame.$('#follow_status_' + __uid).after('<a class="disabled" title="已关注">已关注</a>');
                                    c_frame.$('#follow_status_' + __uid).remove();
                                } else if (__from == '0') {
                                    /*
                                     $('#follow_status_' + __uid).attr('className',cls);
                                     $('#follow_status_' + __uid).attr('title','已经关注此用户');
                                     $('#follow_status_' + __uid).html('已关注');
                                     */
                                    if (html.search("successful") == -1) {
                                        $('#follow_status_' + __uid).attr('className', 'btn-alreadyfollow');
                                        $('#follow_status_' + __uid).html('<a rel="#sure_modal" href="javascript:;" onclick="parent.delFollowModal(this,' + __uid + ');" title="取消关注">取消关注</a>');
                                    } else {
                                        $('#follow_status_' + __uid).attr('className', 'btn-eachotherfollow');
                                        $('#follow_status_' + __uid).html('<a rel="#sure_modal" href="javascript:;" onclick="parent.delFollowModal(this,' + __uid + ');" title="互相关注">取消关注</a>');
                                    }
                                } else if (__from == "addAttention 2") {
                                    c_frame.$('#follow_status_' + __uid).html('<a rel="#sure_modal" href="javascript:;" onclick="parent.delFollowModal(this,' + __uid + ');" class="deleteAttention" title="取消关注">取消关注</a></div>');
                                }
                            }
                        }
                    });
                }

            </script>
            <!--个人信息 End-->
            <!-- 导航 -->
            <ul class="user-nav clearfix">
                <li class="n1">
                    <div class="index title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('index',this);return
                        false;">我的主页</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=index">我的主页</a>
                    </div>
                </li>
                <li class="n12">
                    <div class="record title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('recycle',this);return
                        false;">我的回收站</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=record">浏览记录</a>
                    </div>
                    <!--<div class="total">(0)</div>-->
                </li>
                <li class="n2">
                    <div class="fposts title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('fposts',this);return
                        false;">提到我的</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=fposts">提到我的</a>
                    </div>
                </li>
                <li class="n3">
                    <div class="reme title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('reme',this);return false;">回复我的</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=reme">回复我的</a>
                    </div>
                </li>
                <li class="n4">
                    <div class="reply title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('reply',this);return
                        false;">我的回复</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=reply">我的回复</a>
                    </div>
                    <!--<div class="total">(-1)</div>-->
                </li>
                <li class="n5">
                    <div class="collection title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('collection',this);return
                        false;">我的收藏</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=collection">我的收藏</a>
                    </div>
                    <!--<div class="total">(0)</div>-->
                </li>
                <li class="n6">
                    <div class="sms title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('sms',this);return false;">我的私信</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=sms">我的私信</a>
                    </div>
                    <div class="operating c-main">
                        <!-- a href="javascript:;" onclick="KD.user.goto('sendSMS',this);return
                        false;">发信息</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=sendSMS">发信息</a>
                    </div>
                </li>
                <li class="n7">
                    <div class="topic title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('topic',this);return
                        false;">我的主帖</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=topic">我的主帖</a>
                    </div>
                    <!--<div class="total">(1)</div>-->
                    <div class="operating c-main">
                        <a href="http://upfile1.kdnet.net/post.asp?action=new&amp;boardid=1" title="发布新帖"
                           target="_blank">发新帖</a>
                    </div>
                </li>
                <li class="n8">
                    <div class="blog title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('blog',this);return false;">我的博文</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=blog">我的博文</a>
                    </div>
                    <!--<div class="total">(0)</div>-->
                    <div class="operating c-main">
                        <a href="http://blog.kdnet.net/BokeManage.asp?s=1&amp;t=1&amp;m=1" title="发博客文章"
                           target="_blank">写博文</a>
                    </div>
                </li>
                <!-- -->
                <li class="n9">
                    <div class="t title">
                        <!-- a href="javascript:;" onclick="KD.user.goto('t',this);return false;">我的微评</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=t">我的微评</a>
                    </div>
                    <!--<div class="total">(0)</div>-->
                    <div class="operating c-main">
                        <a href="http://t.kdnet.net/" title="发博微评" target="_blank">写微评</a>
                    </div>
                </li>
                <li class="n10">
                    <div class="recycle title">
                        <a href="http://user.kdnet.net/index.asp?Redirect=recycle">我的回收站</a>
                    </div>
                </li>
                <script language="JavaScript">
                    $(function() {
                        $('#myurlnav').click(function() {
                            $('body').attr({
                                'class': 'urlnav'
                            });
                            scrollTo(0, 0);
                        });
                    });


                </script>
                <li class="n11 last">
                    <div class="title">
                        <a href="http://user.kdnet.net/user.asp?a=logout">退出</a>
                    </div>
                </li>
            </ul>
            <!-- 导航 End -->
            <!--关注我的人-->
            <div class="sc fold">
                <h3>
                    <div style="float:left">
                        <span>我的粉丝<span class="c-main">0</span>人</span>
                    </div>
                    <a class="btn" href="javascript:;"
                       title="收起">
                    </a>
                </h3>
                <div id="fans_panel">
                    <div class="defaultcont">暂无粉丝</div>
                </div>
            </div>
            <!--关注我的人 End-->
            <!--我关注的人-->
            <div class="sc">
                <h3>
                    我关注<span class="c-main">0</span>人
                    <a class="btn" href="javascript:;"
                       title="展开"></a>
                </h3>
                <div id="follow_panel" style="display:none;">
                    <div class="defaultcont">无关注的人</div>
                </div>
            </div>
            <!--取消关注modal-->
            <div class="info-boder" id="sure_modal" style="display:none;width:300px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="popuplayerinfo">
                    <tbody>
                    <tr>
                        <td class="tl"></td>
                        <td height="10" class="tc"></td>
                        <td class="tr"></td>
                    </tr>
                    <tr>
                        <td class="lc">
                        </td>
                        <td class="cc" valign="top" bgcolor="#f0f3f5">
                            <div class="title-info clearfix">
                                <div class=" f14px fB">温馨提示</div>
                                <div class="close-info">
                                    <a class="close" href="javascript:;" title="关闭">关闭</a>
                                </div>
                            </div>
                            <div class="info-cont clearfix">
                                <div class="info-cont-icon"></div>
                                <div class="info-cont-text">您确定要取消对此人的关注？</div>
                            </div>
                            <div class="btn-info">
                                <div class="clearfix">
                                    <a class="ok" href="javascript:;">确定</a>
                                    <a class="close" href="javascript:;" title="取消">取消</a>
                                </div>
                            </div>
                        </td>
                        <td class="rc"></td>
                    </tr>
                    <tr>
                        <td class="bl"></td>
                        <td height="10" class="bc"></td>
                        <td class="br"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--取消关注modal End-->
            <!--我关注的人 End-->
            <!--谁访问过我-->
            <div class="sc">
                <h3>
                    <div style="float:left">
                        <span>谁访问过我</span>
                    </div>
                    <a class="btn" href="javascript:;"  title="展开"></a>
                </h3>
                <div id="by_visit" style="display:none;">
                    <div class="defaultcont">暂无记录！</div>
                </div>
            </div>
            <!--//谁访问过我-->
            <!--我访问过谁-->
            <div class="sc">
                <h3>
                    <div style="float:left">
                        <span>我访问过谁</span>
                    </div>
                    <a class="btn" href="javascript:;"  title="展开"></a>
                </h3>
                <div id="visit" style="display:none;">
                    <div class="defaultcont">暂无记录！</div>
                </div>
            </div>
            <!--//我访问过谁-->
            <!--黑名单-->
            <div class="sc">
                <h3>
                    <div style="float:left">
                        <span>黑名单</span>
                    </div>
                    <a class="btn" href="javascript:;" title="展开"></a>
                </h3>
                <div id="black_list" style="display:none;">
                    <div class="defaultcont">暂无记录！</div>
                    <div class="more c-main">
                        <!-- a href="javascript:;" onclick="KD.user.goto('black',this);return
                        false;">设置黑名单 &gt;&gt;</a -->
                        <a href="http://user.kdnet.net/index.asp?Redirect=black">设置黑名单 &gt;&gt;</a>
                    </div>
                </div>
            </div>
            <!--//黑名单-->
        </div>
        <div class="rf">
            {{--<iframe id="c_frame" name="c_frame" width="100%" frameborder="no" scrolling="no"--}}
            {{--src="../control_base.html" height="952" allowtransparency="true">--}}
            {{--</iframe>--}}
            <script type="text/javascript">
                cf = document.getElementById("c_frame");
                cfw = document.getElementById("c_frame").contentWindow;

                var curLocation = document.location.hash.replace('#', '');
                if (curLocation != '' && KD.user.navData[curLocation] != 'undefined') {
                    KD.user.goto(curLocation);
                } else {

                    KD.user.goto('index');

                }
            </script>
            <script>
                KD.user.goto('setting');
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
<script type="text/javascript">
    //导航鼠标滑过控制
    $('.user-nav li').mouseover(function() {
        $(this).addClass("mouseover");
    });
    $('.user-nav li').mouseout(function() {
        $(this).removeClass("mouseover");
    });

    //更多个人信息显示、隐藏
    function toggleCont(id, el) {
        $(el).parent().parent().toggleClass('fold');
        if (el.title == "收起") {
            $('#' + id).css('display', 'none');
            el.title = "展开";
        } else {
            $('#' + id).css('display', '');
            el.title = "收起";
        }
    }
    $('.more-show').click(function() {
        $(this).hide();
        $('.detailed-more-cont').fadeIn();
    });
    $('.more-hide').click(function() {
        $('.more-show').fadeIn();
        $('.detailed-more-cont').hide();
    });

    function reinitIframe() {
        try {
            var bHeight = cf.contentWindow.document.body.scrollHeight;
            var dHeight = cf.contentWindow.document.documentElement.scrollHeight + 20;
            var height = Math.min(bHeight, dHeight);
            if (height == 0) {
                height = Math.max(bHeight, dHeight);
            }
            cf.height = height + 100;
        } catch(ex) {}
    }
    window.setInterval("reinitIframe()", 400);

    var imageOverlay = $('#img_overlay_trigger').overlay({
        expose: {
            color: '#000',
            opacity: 0.2,
            closeSpeed: 1000
        },
        top: 'center'
    });
</script>
<!--div id="panda_user_index_s_1" style="display:none"><script type="text/javascript" src="http://panda.kdnet.net/data/user_index_s_1.js"></script></div>
<div id="panda_user_index_l_1" style="display:none"><script type="text/javascript" src="http://panda.kdnet.net/data/user_index_l_1.js"></script></div>
<div id="panda_user_index_r_1" style="display:none"><script type="text/javascript" src="http://panda.kdnet.net/data/user_index_r_1.js"></script></div-->
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
<script>
    document.onmousemove = function() {
        document.getElementById('update_flag').innerHTML = 1;
    };
    document.onscroll = function() {
        document.getElementById('update_flag').innerHTML = 1;
    };
    var tracking_starttime = "1507661855";
    tracking_log();

    function openurl(url, div, count) {
        window.open(url);
        $("#" + div).hide();
        if (count == 1) $("#ajax_header").html('');
    }

    function upheader() {
        $.ajax({
            url: 'ajax_update_header.asp',
            type: "GET",
            cache: false,
            success: function(html) {
                $("#ajax_header").html('');
            }
        });
    }

    function UpdateHeader(flag) {
        if (document.getElementById('update_flag').innerHTML == "1" || flag == 0) {
            $.ajax({
                url: 'ajax_header.asp',
                type: "GET",
                cache: false,
                success: function(html) {
                    $("#ajax_header").html(html);
                    if (html != "") $("#ajax_header").css('display', 'block');
                    else $("#ajax_header").css('display', 'none');
                }
            });
            document.getElementById('update_flag').innerHTML = "0";
        }
    }

    $(document).ready(function() {
        UpdateHeader(0);
        setInterval("UpdateHeader(1)", 30000);
    });

    //勋章查看
    $(".slidetabs").tabs(".images > div", {
        //启用“渐隐”效果
        effect: 'fade',
        fadeOutSpeed: "slow",
        //结束后从开始重复滚动
        rotate: false
        //使用幻灯片插件。它接受自己的配置，禁用点击层翻页
    }).slideshow({
        clickable: false
    });

    $(".ad-xz li>img[title]").tooltip({
        offset: [ - 2, 0]
    });
    $(".ad-xz-l a>img[title]").tooltip({
        position: "top right",
        offset: [ - 2, -18]
    });
</script>
<script type="text/javascript">
    _atrk_opts = {
        atrk_acct: "qlI7j1a4ZP00wT",
        domain: "kdnet.net",
        dynamic: true
    }; (function() {
        var as = document.createElement('script');
        as.type = 'text/javascript';
        as.async = true;
        as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js";
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(as, s);
    })();
</script>
</body>

</html>