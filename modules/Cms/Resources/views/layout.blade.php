<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Numencode Demo App">
    <meta name="author" content="Numencode.com">

    <title>Numencode Demo App</title>

    <base href="{{ env('app_url') }}">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('css/libs.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Numencode</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                @if ($signedIn)
                    <li><a href="{{ route('profile') }}">My Profile</a></li>
                    @can('manage_posts')
                        <li><a href="#">My posts</a></li>
                    @endcan
                @else
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            </ul>
            @if ($signedIn)
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
                <p class="navbar-text navbar-right">
                    Logged in as {{ $user->name }} @if ($user->nickname)<small>({{ $user->nickname }})</small>@endif
                </p>
                @if ($user->avatar)
                    <img src="/{{ $user->avatar_thumbnail }}" class="navbar-right user-avatar-small">
                @endif
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="/js/libs.js"></script>
<script src="/js/app.js"></script>

@include('theme::flash')

</body>
</html>