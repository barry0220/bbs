<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
<a href="{{ URL('home/active?uid='.$user->id.'&usertoken='.$user->user_token.'&email='.$email )}}" target="_blank">点击激活你的账号</a>
</body>
</html>