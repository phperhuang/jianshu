<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/layer/layer.js') }}"></script>
    <link rel="stylesheet" href="{{ url('js/layer/theme/default/layer.css') }}">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('css/ionicons.min.css') }}">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/_all-skins.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('css/_all.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
@php
$logout_msg = cache('logout_msg');
if($logout_msg){
    echo "<script>layer.alert('" . $logout_msg . "');</script>";
}
cache()->forget('logout_msg');
@endphp

</head>
<body class="hold-transition login-page">
<div class="login-box" style="width: 440px;">
    <div class="login-logo">
        <h1><a href="{{ url('/home') }}">{{env('APP_NAME')}}</a></h1>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        {{--<form method="post" action="{{ url('/login') }}">--}}
        <form method="post" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="用户名">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="密码" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            </div>
            @include('layout.error')
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            {{--<input type="checkbox" name="remember">记住密码--}}
{{--                            <input type="checkbox">记住密码--}}
                            <a href="{{ url('/register') }}">注册新用户</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- AdminLTE App -->
<script src="{{ url('js/adminlte.min.js') }}"></script>

<script src="{{url('js/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
