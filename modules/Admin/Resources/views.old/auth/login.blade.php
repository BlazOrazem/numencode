<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NumencodeCMS">
    <meta name="author" content="Numencode.com">
    <title>Admin Dashboard</title>
    <base href="{{ env('app_url') }}">
    <link href="{{ elixir('css/admin-app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('css/admin-libs.css') }}" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('admin.login.action') }}" role="form">
                        {!! csrf_field() !!}
                        @if (isset($ref))
                            <input type="hidden" name="ref" value="{{ $ref }}">
                        @endif
                        <fieldset>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail address" autofocus>
                                <span class="help-block">{!! $errors->first('email', ':message') !!}</span>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input type="password" class="form-control" name="password" placeholder="Password" value="">
                                <span class="help-block">{!! $errors->first('password', ':message') !!}</span>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/admin-libs.js"></script>
<script src="js/admin-app.js"></script>

@include('admin::flash')

</body>
</html>