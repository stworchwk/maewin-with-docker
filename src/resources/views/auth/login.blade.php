<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Artisan Factory Cafe' & Restaurant</title>
    <!-- Main styles for this application-->
    <link href="/css/app.css" rel="stylesheet">
    @yield('link')
    <link rel="icon" href="{!! url('images/templates/favicon.ico') !!}">
</head>
<body class="app flex-row align-items-center" style="background-image: url({!! url('images/templates/bg.jpg') !!});
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h1>เข้าสู่ระบบ</h1>
                            <p class="text-muted">เข้าสู่ระบบด้วยบัญชีของคุณ</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
<span class="input-group-text">
<i class="fa fa-user"></i>
</span>
                                </div>
                                <input type="text" id="username" name="username"
                                       class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                       placeholder="Username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
<span class="input-group-text">
<i class="fa fa-lock"></i>
</span>
                                </div>
                                <input type="password" name="password" id="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block px-4">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-transparent py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <img src="{!! url('images/templates/logo.png') !!}" width="70%" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/app.js"></script>
@yield('script')
<script>
    $('#ui-view').ajaxLoad();
    $(document).ajaxComplete(function () {
        Pace.restart()
    });
</script>
@if(Session::has('success'))
    <script>
        alert.message('{{Session::get('success')}}', 'success');
    </script>
@elseif($errors->any())
    <script>
        alert.message('{!! $errors->first() !!}', 'error');
    </script>
@endif
</body>
</html>
