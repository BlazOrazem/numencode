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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="flag flag-{{ app()->getLocale() }}"></span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ get_route('en:home') }}">English</a>
                        </li>
                        <li>
                            <a href="{{ get_route('sl:home') }}">Slovenščina</a>
                        </li>
                    </ul>
                </li>
                <li><a href="/">@lang('theme::general.home')</a></li>
                @foreach ($menu as $page)
                    @if ($page->items->count())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $page->title }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @foreach($page->items as $item)
                                    <li>
                                        <a href="{{ $item->link }}">{{ $item->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ $page->link }}">{{ $page->title }}</a>
                        </li>
                    @endif
                @endforeach
                @if ($signedIn)
                    @can('manage_posts')
                        <li><a href="#">My posts</a></li>
                    @endcan
                @else
                    <li><a href="{{ get_route('register') }}">Register</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if ($signedIn)
                <li><a href="{{ route('profile') }}">{{ $user->name }}</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif

            </ul>
            @if ($signedIn && $user->avatar)
                <img src="{{ $user->avatar }}" height="40" class="navbar-right user-avatar-small visible-lg">
            @endif
        </div>
    </div>
</nav>