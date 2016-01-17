<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <base href="{{ env('app_url') }}">
    <link href="{{ elixir('css/admin-app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('css/admin-libs.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin_home') }}">Admin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li><a href="/" target="_blank">App home</a></li>
            </ul>
            @if ($signedIn)
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('admin_logout') }}">Logout</a></li>
                </ul>
                <p class="navbar-text navbar-right">
                    Logged in as {{ $manager->name }}
                </p>
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="js/admin-libs.js"></script>
<script src="js/admin-app.js"></script>

@include('admin::flash')

</body>
</html>