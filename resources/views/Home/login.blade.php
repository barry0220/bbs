<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>凯迪论坛 | 登录页面</title>
    <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
    <script type="text/javascript">
        var $CONFIG = {};
        $CONFIG['a_host'] = 'http://fat.com';
        $CONFIG['a_format'] = 'json';
    </script>
    {{--<script src="{{asset('/home/js/jquery-2.1.1.js')}}"></script>--}}
    {{--<script src="{{asset('/home/js/bootstrap.min.js')}}"></script>--}}
    <script type="text/javascript">
        !function(a, b) {
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
                        c.src = "dddddddddddd",
                        d = a.getElementsByTagName("script")[0],
                        d.parentNode.insertBefore(c, d)
                }
            } (document, window.dplus || []),
            dplus.init("1260004087");
    </script>
    {{--
    <!--[if gte IE 9]>
        --}}
    <script type="text/javascript" src="{{asset('/home/js/flexible.js')}}"></script>
    {{--
<![endif]-->
--}}
<!--&lt;!&ndash;[if lt IE 9]>
            -->
    <script src="{{asset('/home/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('/home/js/respond.min.js')}}"></script>
    {{--
<![endif]-->
--}}
    <script type="text/javascript">
        _atrk_opts = {
            atrk_acct: "qlI7j1a4ZP00wT",
            domain: "http://fat.com",
            dynamic: true
        };
        (function() {
            var as = document.createElement('script');
            as.type = 'text/javascript';
            as.async = true;
            as.src = "{{asset('/home/js/atrk.js')}}";
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(as, s);
        })();
    </script>
    <noscript>
        <img src="{{asset('/home/img/atrk.gif-account=qlI7j1a4ZP00wT.gif')}}" style="display:none" height="1" width="1" alt="" />
    </noscript>
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/common.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/jquery.webui-popover.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/login.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/email-autocomplete.css')}}"/>
    {{--<link href="{{asset('/home/css/bootstrap.min.css')}}" rel="stylesheet">--}}
</head>

<body>
<div class="modal fade" id="qrcodeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">扫二维码登录</h4>
            </div>
            <div class="modal-body login-wrap">
                <div id="qrcode" class="row" style="text-align: center;">
                    这里放一个二维码
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="verifyModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">请输入下图中的文字或字母</h4>
            </div>
            <div class="modal-body text-center" id="verifyModal-body">
            </div>
        </div>
    </div>
</div>
<div class="login-wrap pc-login-wrap" data-key="0.76460900 1507623358">
    <header>
        <h1>
            <a href="{{url('/home/index')}}" target="_blank">
                <img src="{{asset('/home/img/logo_login@2x.e634babc.png')}}" class="img-responsive" alt="凯迪 - 客观 公正 理性 宽容">
            </a>
        </h1>
    </header>
    <div><a href="javascript:;"></a></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-push-7 kdnet-login">
                <ul class="j-logintabs login-tab">
                    <li class="active formLogin">
                        <a href="#" data-target="#formLogin">登录</a>
                    </li>
                    <li>
                        ·
                    </li>
                    <li class="formRegister">
                        <a href="#formRegister" data-target="#formRegister">注册</a>
                    </li>
                </ul>
                <div class="row">
                @if (count($errors) > 0)
                    <div class="alert" style="color:red;list-style: circle;">
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
                </div>
                <div class="tab-content">
                    <form class="tab-pane fade in active" id="formLogin" method="post" action="{{url('/home/dologin')}}">
                        <div class="form-group">
                            <label class="sr-only" for="EmailPhoneNcke">手机/邮箱/凯迪昵称</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-user"></span>
                                </div>
                                <input type="text" class="form-control" id="EmailPhoneNcke" name="EmailPhoneNcke" placeholder="手机/邮箱/凯迪昵称" value="{{old('EmailPhoneNcke')}}" aria-invalid="true">
                                <i></i>
                            </div>
                        </div>
                        <div class="form-group login-pwd">
                            <label class="sr-only" for="Password">登录密码</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-unlock-alt"></span>
                                </div>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="登录密码" value="{{old('password')}}" required>
                                <i></i>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="sr-only" for="EmailPhoneNcke">验证码</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-cog"></span>
                                    </div>
                                    <input type="text" class="form-control" id="homecode" name="homecode" placeholder="请输入验证码" value="{{old('homecode')}}" aria-invalid="true">
                                    {{--<a onclick="javascript:re_captcha();">--}}
                                        {{--<img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">看不清？点击图片换一张</a>--}}
                                    {{--</a>--}}
                                    <i></i>
                                </div>
                                <div class="form-group">
                                    <div class="input-group" style="padding-top:10px;">
                                            <img src="{{ URL('/code/captcha/1') }}" onclick="javascript:re_captcha();" id="code">&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="javasript:;" onclick="javascript:re_captcha();">看不清？点击更换</a>
                                        <i></i>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            {{csrf_field()}}
                            <button class="btn btn-primary btn-block btn-lg" type="submit" name="submit"
                                    data-loading-text="<i class='fa fa-refresh fa-spin'></i> 正在登录…">登录
                            </button>
                        </div>
                        <p class="text-right small mt10">
                            <a href="{{url('/home/forget')}}">忘记登录密码?</a>
                        </p>
                    </form>
                    <form class="tab-pane" id="formRegister" action="{{url("/home/doregister")}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputEmailPhone" name="inputEmailPhone" placeholder="手机(仅支持大陆手机)">
                            <i></i>
                        </div>
                        <div class="form-group code-group">
                            <input type="text" class="form-control" id="inputAuthcode" maxlength="6" name="inputAuthcode" placeholder="6位数验证码">
                            <i></i>
                            <div class="verify-btn">
                                <button type="button" data-backdrop="static" data-keyboard="false" href="javascript:void(0);"
                                        class="btn btn-default btn-sm j-verify-btn" disabled="true">
                                    请先验证手机
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                                   maxlength="20" placeholder="设置登录密码">
                            <i></i>
                            <div id="level" class="pw-strength">
                                <div class="pw-bar">
                                    <b>弱</b>
                                    <b>中</b>
                                    <b>强</b>
                                </div>
                                <div class="pw-bar-on">
                                    <b>弱</b>
                                    <b>中</b>
                                    <b>强</b>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputNickname" name="inputNickname"
                                   maxlength="16" placeholder="昵称">
                            <i></i>
                            <div class="explain">
                                <s class="fa fa-exclamation-circle"></s>
                                <p>昵称是您的唯一名称，注册后无法修改，请谨慎填写！3~16个字符，字母/中文/数字/下划线。</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg" name="submit"
                                    data-loading-text="<i class='fa fa-refresh fa-spin'></i> 正在提交…">
                                同意以下协议并注册
                            </button>
                        </div>
                        <div class="agreement">
                            <a href="{{url('/home/agreement')}}}" target="_blank">
                                《凯迪网络服务协议和声明》
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-7 col-sm-pull-5 other-login">
                <h3>无需注册，直接使用以下帐号登录：</h3>
                <div class="row">
                    <div class="col-sm-5 col-xs-3">
                        <a class="btn btn-primary btn-lg btn-weibo" href="../">
                            <span class="fa fa-weibo"></span>
                            <b>新浪微博登录</b>
                        </a>
                    </div>
                    <div class="col-sm-5 col-xs-3">
                        <a class="btn btn-primary btn-lg btn-wechat" data-toggle="modal" data-target="#qrcodeModal"
                           data-backdrop="static" data-keyboard="false" href="javascript:void(0);">
                            <span class="fa fa-wechat"></span>
                            <b>腾讯微信登录</b>
                        </a>
                    </div>
                    <div class="col-sm-5 col-xs-3">
                        <a class="btn btn-primary btn-lg btn-qq" href="../">
                            <span class="fa fa-qq"></span>
                            <b>QQ帐号登录</b>
                        </a>
                    </div>
                    <div class="col-sm-5 col-xs-3">
                        <a class="btn btn-primary btn-lg btn-tencent-weibo" href="../">
                            <span class="fa fa-tencent-weibo"></span>
                            <b>腾讯微博登录</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="nav">
            <a href="../" target="_blank" class="mlr5">关于凯迪</a>|
            <a href="../" target="_blank" class="mlr5">联系我们</a>|
            <a href="../" target="_blank" class="mlr5">广告服务</a>|
            <a href="../" target="_blank" class="mlr5">法律声明</a>|
            <a href="../" target="_blank" class="mlr5">加入凯迪</a>|
            <a href="../" target="_blank" class="mlr5">网站地图</a>
        </div>
        <p class="copyright">
            Copyright<span class="mlr5">&copy;</span>2000~2017
            <a href="../" target="_blank" class="mlr5">kdnet.net</a>
            All Rights Reserved
        </p>
    </footer>
    <script type="text/javascript" src = "{{asset('/home/js/atrk.js')}}"></script>


    <noscript>
        <img src="{{asset('/home/img/atrk.gif-account=qlI7j1a4ZP00wT.gif')}}"
             style="display:none" height="1" width="1" alt="" />
    </noscript>
</div>
</body>
<script type="text/javascript" src="{{asset('/home/js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/email-autocomplete.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/wxLogin.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/gt.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/login.js')}}"></script>
<script type="text/javascript">

    function re_captcha() {
        $url = "{{ URL('/homecode/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('code').src = $url;
    }

//    !function() {
//            require('login:static/util/code.validate.js');
//            require('login:static/util/login.validate.js').init({
//                    "kdnetapiformat": "json",
//                    "register": {
//                        "uri": "i.kdnet.net\/api\/passport\/register"
//                    },
//                    "only": {
//                        "uri": "i.kdnet.net\/api\/passport\/query"
//                    },
//                    "activating": {
//                        "uri": "i.kdnet.net\/api\/passport\/activating"
//                    },
//                    "examine": {
//                        "uri": "i.kdnet.net\/api\/passport\/examine"
//                    },
//                    "captcha": {
//                        "uri": "i.kdnet.net\/api\/passport\/captcha"
//                    },
//                    "sendCode": {
//                        "uri": "i.kdnet.net\/api\/passport\/sendCode"
//                    },
//                    "authorize": {
//                        "uri": "i.kdnet.net\/api\/passport\/authorize"
//                    },
//                    "forget": {
//                        "uri": "i.kdnet.net\/api\/passport\/forget"
//                    },
//                    "modify": {
//                        "uri": "i.kdnet.net\/api\/passport\/modify"
//                    }
//                },
//                "");

            $(function() {
                $('.j-logintabs a').click(function (e) {
                    $(this).tab('show');
                });

            });
        } ();
</script>

</html>