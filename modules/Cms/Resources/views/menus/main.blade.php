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
            <ul class="nav navbar-nav">
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
            </ul>
        </div>
    </div>
</nav>