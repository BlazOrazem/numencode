<ul class="{{ $class }}">
    @foreach ($collection as $item)
        @include ('theme::menus.corpo_item')
    @endforeach
</ul>