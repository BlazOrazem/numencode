<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Numencode">
    <meta name="author" content="Numencode.com">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            Numencode Demo Website
        @endif
    </title>

    <base href="{{ env('app_url') }}">
    <link href="{{ mix('/themes/default/css/app.css') }}" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
        <script src="themes/default/js/html5shiv.min.js"></script>
        <script src="themes/default/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

@menu('sidebar')

@menu('main')

@hasSection('jumbotron')
    <div class="jumbotron">
        <div class="container">
            @yield('jumbotron')
        </div>
    </div>
@endif

<div class="container">
    @hasSection('title')
        <div class="page-header">
            <h1>@yield('title')</h1>
        </div>
    @endif

    @hasSection('content')
        @yield('content')
    @endif

    @hasSection('plugins_center')
        <div class="center-position">
            @yield('plugins_center')
        </div>
    @endif

    @hasSection('plugins_bottom')
        <hr>
        <div class="bottom-position">
            @yield('plugins_bottom')
        </div>
    @endif
</div>

@include('theme::footer')

</body>
</html>
