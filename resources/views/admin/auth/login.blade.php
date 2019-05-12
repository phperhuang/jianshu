<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X_UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="{{ url('css/layui/css/layui.css') }}" media="all">
    <title>简书后台登陆</title>
    <style type="text/css">
        body {background:#1d598e;}
        .layui-input{height:45px;width:87%; padding-left: 5px;font-size:16px;display:inline-block;}
        .layui-btn {height:45px;}
        .captcha-input {height:45px; padding-left: 5px;font-size:16px;}
        .layui-form {width:20%;height:20%;margin:0 auto;margin-top:10%;padding:15px 28px 0px;background:#fff;}
        .layui-input-block {margin-left:0;}
        .layui-input-block a {color:blue;float:right;line-height:30px;font-size:14px;}
        h1 {text-align:center;color:#1d598e;}
    </style>
</head>
<body>
<form class="layui-form" action="{{ url('admin/login') }}" method="post">
    <div class="layui-form-item">
        <h1>简书后台登录</h1>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="layui-form-item">
        <div class="layui-input-block">
            <span class="decrib">帐户：</span>
            <input type="text" name="name" placeholder="请输入账号" autocomplete="off" class="layui-input" autofocus="true" required>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <span class="decrib">密码：</span>
            <input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input" required>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="checkbox" name="rememberMe" class="layui-input" value="1" lay-skin="primary" title="记住密码">
            <a href="#">忘记密码？</a>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-fluid" type="submit">登 录</button>
        </div>
    </div>
    @include('layout.error')
</form>
</body>
</html>