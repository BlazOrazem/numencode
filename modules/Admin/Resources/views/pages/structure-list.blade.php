<ul class="nestable-list">
    @foreach ($collection as $item)
        @include ('admin::pages.structure-item')
    @endforeach
</ul>