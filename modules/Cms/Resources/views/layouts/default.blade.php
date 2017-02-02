<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Numencode">
    <meta name="author" content="Numencode.com">

    <title>Numencode</title>

    <base href="{{ env('app_url') }}">
    <link href="{{ elixir('themes/default/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('themes/default/css/libs.css') }}" rel="stylesheet" type="text/css">
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
                    <li><a href="{{ get_route('register') }}">Register</a></li>
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
                    <img src="{{ $user->avatar }}" height="40" class="navbar-right user-avatar-small">
                @endif
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>

<hr>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false" aria-controls="main-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Main menu</a>
        </div>
        <div id="main-menu" class="collapse navbar-collapse">
            @include ('theme::menus.main_list', ['collection' => $mainMenu['root'], 'class' => 'nav navbar-nav'])
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')

    <div class="plugins">
        @yield('plugins')
    </div>
</div>

<hr>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#corpo-menu" aria-expanded="false" aria-controls="corpo-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Corpo menu</a>
        </div>
        <div id="corpo-menu" class="collapse navbar-collapse">
            @include ('theme::menus.corpo_list', ['collection' => $corpoMenu['root'], 'class' => 'nav navbar-nav'])
        </div><!--/.nav-collapse -->
    </div>
</nav>

<script src="{{ elixir('themes/default/js/app.js') }}"></script>
<script src="{{ elixir('themes/default/js/libs.js') }}"></script>

@include('theme::flash')

</body>
</html>