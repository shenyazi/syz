<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>找回密码邮件注册</title>
</head>
<body>

    <p>请点击 <a href="{{url('home/reset/id='.$user->id.'&key='.$user->name)}}">链接</a> ，找回密码</p>
</body>
</html>