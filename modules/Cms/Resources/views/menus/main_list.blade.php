<ul class="{{ $class }}">
    @foreach ($collection as $item)
        @include ('theme::menus.main_item')
    @endforeach
</ul>