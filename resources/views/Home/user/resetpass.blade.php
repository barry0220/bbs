<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title>忘记密码找回</title>
	<link rel="icon" href="{{asset('/home/css/favicon.ico')}}" type="image/x-icon"/>
	<link rel="shortcut icon" href="{{asset('/home/css/favicon.ico')}}" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="{{asset('/home/css/common.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('/home/css/jquery.webui-popover.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('/home/css/login.css')}}"/>

	<script src="{{asset('/home/js/jquery-2.1.1.js')}}" ></script>
	<script src="{{asset('/home/js/respond.min.js')}}" ></script>

	<script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
</head>

<body>
<div class="login-wrap">
	<header>
		<h1>
			<a href="{{url('/')}}" target="_blank">
				<img src="{{asset('/home/img/logo_login@2x.e634babc.png')}}" class="img-responsive" alt="凯迪 - 客观 公正 理性 宽容">
			</a>
		</h1>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="validate-tab">
					<span>忘记密码</span>
				</div>
			</div>
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
			<div class="col-sm-5 resetPwd">
				<div id="checkfirst">
					<form method="post" action="/12312321" id="checkform">
						<div class="form-group">
							<label class="sr-only" for="phone">手机号</label>
							<input type="tel" class="form-control" name="phone" id="phone" placeholder="输入手机号">
							<i></i>
						</div>
						<div class="form-group code-group">
							<label class="sr-only" for="code">验证码</label>
							<input type="tel" class="form-control" id="phonecode" name="phonecode" maxlength="4" placeholder="4位数验证码">
							<i></i>
							<div class="verify-btn">
								<button type="button" data-backdrop="static" data-keyboard="false" id="checkphone" onclick="sendCode()" href="javascript:void(0);"
										class="btn btn-default btn-sm j-verify-btn" disabled="disabled">
									请先验证手机
								</button>
							</div>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary btn-block btn-lg" data-keyboard="false" onclick="checkCode()" href="javascript:void(0);">验证</button>
						</div>
					</form>
				</div>
				<div id="checksec">
					<form role="form" method="post" action="{{url('/home/forgetrepass')}}" id="checkform">
						<div class="form-group">
							<input type="password" class="form-control" id="inputPassword" name="password"
								   maxlength="20" placeholder="设置新的登录密码">
							<i></i>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="inputRePassword" name="repassword"
								   maxlength="20" placeholder="重复密码">
							<i></i>
						</div>
						<div class="form-group">
							<input type="hidden" name="phonenum" id="phonenum" value="">
							<button type="submit" class="btn btn-primary btn-block btn-lg"
									data-loading-text="<i class='fa fa-refresh fa-spin'></i> 正在提交…">
								重置密码
							</button>
						</div>
						{{csrf_field()}}
					</form>
				</div>


			</div>
		</div>
	</div>
	<footer>
		<div class="nav">
			<a href="javascript:;" target="_blank" class="mlr5">法律声明</a>|
			<a href="javascript:;" target="_blank" class="mlr5">加入凯迪</a>|
			<a href="javascript:;" target="_blank" class="mlr5">网站地图</a>
		</div>
		<p class="copyright">
			Copyright
			<span class="mlr5">&copy;</span>2000~2017
			<a href="javascript:;" target="_blank" class="mlr5">kdnet.net</a>
			All Rights Reserved
		</p>
	</footer>
	<script>
		$(function(){
		    //默认修改表单隐藏
            $("#checksec").hide();
//            $("#checksec").show();
		})
		//验证输入的手机号用户是否存在
        $('#phone').blur(function(){
            var phone = $(this).val();
            var reg = /^1[34578]\d{9}$/;
//			alert(phone);
            if (!reg.test(phone)) {
                layer.msg('手机号格式不正确',{icon:5});
                $('#checkphone').attr('disabled','disabled');
            }else {
                $.post("{{url('/home/issetphone')}}",{'phone':phone,'_token':"{{csrf_token()}}"},function(data){
                    if (data.status == '0') {
                        layer.msg('该用户不存在,请检查确认', {icon: 5});
                        $('#checkphone').attr('disabled','disabled');
                    } else {
                        $('#checkphone').attr('disabled',false);
					}
                });
            }
        });
		//发送手机号验证码
        function sendCode() {

            //获取要发送验证码的手机号
            var phone = $('#phone').val();
//            alert(phone);
            //验证手机号格式
            var reg = /^1[34578]\d{9}$/;
            if (!reg.test(phone)) {
                layer.msg('手机号码格式不正确,请重新输入',{icon: 5});
            } else {

                $.post("{{url('/resetsendcode')}}",{'phone':phone,'_token':"{{csrf_token()}}"},function(data){
                    var data = JSON.parse(data);
                    if(data.status == 0){
                        layer.msg(data.message, {icon: 6});
                        $('#regphone').attr('disabled','true');
                        var time = 59;
                        var wait = setInterval(function(){
                            if (time > 0) {
                                time = time -1;
                                $('#checkphone').text("发送成功请稍候.."+time+'S');
                            } else {
                                $('#checkphone').text("请重新验证手机");
                                $('#checkphone').attr('disabled',false);
                                clearInterval(wait);
                                wait=null;
                            }

                        },1000)
                    }else{
                        layer.msg(data.message[0], {icon: 5});
                    }

                });
            }
        }

        //检查验证码是否正确
        function checkCode() {
                //获取验证码值
				var phone = $('#phone').val();
                var phonecode = $('#phonecode').val();
                var reg = /^1[34578]\d{9}$/;
                if (reg.test(phone)) {

                    //  通过ajax 向服务器发送一个删除请求
                    $.post("{{url('/home/resetcheck/')}}", {'phone':phone,'phonecode': phonecode, '_token': "{{csrf_token()}}"
                    }, function (data) {

                        if (data.status == 0) {
                            layer.msg(data.msg, {icon: 6});
                            setTimeout(function () {
                                $("#checkfirst").hide();
                                $("#checksec").show();
                                $('#phonenum').val(phone);
                            }, 3000)
                        } else {

                            layer.msg(data.msg, {icon: 5});
                        }

                    })
				} else {
                    layer.msg('手机号格式不正确',{icon: 5});
				}
				return false;
        }
	</script>
</div>
</body>
<script type="text/javascript" src="{{asset('/home/js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/gt.js')}}"></script>
<script type="text/javascript" src="{{asset('/home/js/login.js')}}"></script>

</html>