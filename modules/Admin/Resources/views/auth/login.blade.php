<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#49CEFF">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#49CEFF" />
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <meta name="description" content="Numencode CMS">
    <meta name="author" content="Blaz Orazem">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Numencode CMS</title>

    <base href="{{ env('app_url') }}">
    <link href="{{ asset('/themes/admin/css/vendor.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/themes/admin/css/app.css') }}" rel="stylesheet" type="text/css">

    <link rel="icon" href="themes/admin/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="themes/admin/images/favicon.ico" type="image/x-icon" />
</head>

<body class="user-page login" style="background-image: url('/themes/admin/images/background/{{ $season }}.jpg');">
<!--Preloader-->
<div id="preloader">
    <div class="refresh-preloader"><div class="preloader"><i>.</i><i>.</i><i>.</i></div></div>
</div>

<div class="wrapper">
    <div class="table-wrapper text-center">
        <div class="table-row">
            <div class="table-cell">
                <div class="login">
                    <h4 class="text-center">numencode</h4>
                    <form method="POST" action="{{ route('admin.login.post') }}" role="form">
                        {{ csrf_field() }}
                        @if (isset($ref))
                            <input type="hidden" name="ref" value="{{ $ref }}">
                        @endif
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input id="email"
                                   type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="E-mail address"
                                   autocomplete="username"
                                   autofocus>
                            <span class="help-block">{!! $errors->first('email', ':message') !!}</span>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input id="password"
                                   type="password"
                                   class="form-control"
                                   name="password"
                                   placeholder="Password"
                                   autocomplete="current-password">
                            <span class="help-block">{!! $errors->first('password', ':message') !!}</span>
                        </div>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-primary">
                                <label><input type="checkbox" name="remember" value="Remember Me"><i></i></label>
                                <span class="white f-s-16 m-l-5">Remember me</span>
                            </div>
                        </div>
                        <button name="Login" type="submit" class="btn btn-block btn-lg btn-base">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin::footer')

</body>
</html>
