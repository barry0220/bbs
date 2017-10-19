
<!DOCTYPE html>
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>友情提示.</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/style.css')}}">
</head>

<body>

<div class="demo">
    <p><img src="{{asset('/home/img/errors/errors.png')}}" alt="errors" width="50%"></p>
    <p>{{$info}}....<a href="{{url('/')}}">返回首页</a></p>
</div>
</body>
</html>