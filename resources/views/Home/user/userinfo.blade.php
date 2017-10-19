@extends('Layouts.userdetails')

@section('title','个人信息设置');

@section('content')
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


@endsection