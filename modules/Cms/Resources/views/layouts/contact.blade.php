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
</head>

<body>

@menu('sidebar')

@menu('main')

<div class="container">
    @hasSection('title')
        <div class="jumbotron">
            <h1>@yield('title')</h1>
        </div>
    @endif

    @hasSection('content')
        <div class="text-center">
            @yield('content')
        </div>
    @endif

    <div class="col-md-6 col-md-offset-3">
        <form method="POST" action="{{ route('contact') }}" class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">@lang('theme::contact.name')</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputName">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-3 control-label">@lang('theme::contact.email')</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="inputEmail">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhone" class="col-sm-3 control-label">@lang('theme::contact.phone')</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPhone">
                </div>
            </div>
            <div class="form-group">
                <label for="inputMessage" class="col-sm-3 control-label">@lang('theme::contact.message')</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="5" id="inputMessage"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">@lang('theme::contact.submit')</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('theme::footer')

</body>
</html>
