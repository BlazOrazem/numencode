<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle">
    <i class="fa fa-bars"></i>
</a>

<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
        <li class="sidebar-brand">
            <a href="#top" onclick=$("#menu-close").click();>@lang('theme::general.sidebar_menu')</a>
        </li>
        @foreach ($menu as $page)
        <li>
            <a href="{{ $page->link }}">{{ $page->title }}</a>
        </li>
        @endforeach
    </ul>
</nav>