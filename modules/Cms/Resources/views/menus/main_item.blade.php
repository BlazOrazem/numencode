@if (isset($mainMenu[$item->id]))
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $item->title }} <b class="caret"></b></a>
        @include ('theme::menus.main_list', ['collection' => $mainMenu[$item->id], 'class' => 'dropdown-menu'])
    </li>
@else
    <li>
        <a href="{{ isset($item->url->uri) ? $item->url->uri : '#' }}">{{ $item->title }}</a>
    </li>
@endif