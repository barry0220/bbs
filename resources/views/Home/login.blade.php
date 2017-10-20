<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>凯迪论坛 | 登录页面</title>
    <link rel="icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('/home/img/favicon.ico')}}" type="image/x-icon"/>
    <script type="text/javascript" src="{{asset('/home/js/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/email-autocomplete.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/wxLogin.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/gt.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/login.js')}}"></script>


    {{--<script src="{{asset('/home/js/jquery-2.1.1.js')}}"></script>--}}
    {{--<script src="{{asset('/home/js/bootstrap.min.js')}}"></script>--}}

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
            <a href="{{url('/')}}" target="_blank">
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
                        <a href="{{asset('/home/login')}}"  id="showlogin">登录</a>
                    </li>
                    <li>
                        ·
                    </li>
                    <li class="formRegister">
                        <a href="{{asset('/home/register')}}"  id="showregister">注册</a>
                    </li>
                </ul>
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
                <div class="tab-content">
                    <form class="tab-pane fade in active" id="formLogin" action="{{url('/home/dologin')}}" method="post">
                        <div class="form-group">
                            <label class="sr-only" for="EmailPhoneNcke">手机/邮箱/凯迪昵称</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-user"></span>
                                </div>
                                <input type="text" class="form-control" id="EmailPhoneNcke" name="EmailPhoneNcke" placeholder="手机/邮箱/凯迪昵称" aria-invalid="true">
                                <i></i>
                            </div>
                        </div>
                        <div class="form-group login-pwd">
                            <label class="sr-only" for="Password">登录密码</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-unlock-alt"></span>
                                </div>
                                <input type="password" class="form-control" id="Password" name="password" placeholder="登录密码" required>
                                <i></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-unlock-alt"></span>
                                </div>
                                <input type="text" class="form-control" placeholder="验证码" name="code" required="" value="{{old('code')}}"><br>
                            </div>&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <img src="{{ URL('/homecode/captcha/1') }}" id="codeimg" onclick="javascript:re_captcha();">&nbsp;
                                <a href="#" onclick="javascript:re_captcha();">看不清？点击图片换一张</a>
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
    <script type="text/javascript">
        function re_captcha() {
            $url = "{{ URL('/homecode/captcha') }}";
            $url = $url + "/" + Math.random();
            document.getElementById('codeimg').src = $url;
        }
    </script>
</div>
</body>
</html>