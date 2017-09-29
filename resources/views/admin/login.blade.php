<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login 2</title>

    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">



</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to IN+</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
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

                    <form class="m-t" role="form" action="{{url('admin/dologin')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="用户名" name="username" required="" value="{{old('username')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="密码" name="password" required="" value="{{old('password')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="验证码" name="code" required="" value="{{old('code')}}"><br>
                            {{--<img src="{{url('admin/yzm')}}" onclick="this.src='{{url('admin/yzm')}}?'+Math.random()" alt="">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">看不清？点击图片换一张</a>--}}
                            <a onclick="javascript:re_captcha();">
                                <img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">看不清？点击图片换一张</a>
                            </a>
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="#">
                            <small>忘 记 密 码 ？</small>
                        </a>


                    </form>
                    <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    function re_captcha() {
        $url = "{{ URL('/code/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
    }
</script>
</html>
