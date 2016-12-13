<ul class="nestable-list">
    @forelse ($collection as $item)
        @include ('admin::pages.structure-item')
    @empty
        <li class="nestable-item">
            <div class="nestable-handle">
                <div class="left">
                    <i class="zmdi zmdi-folder-outline"></i>
                    Menu type has no elements.
                </div>
            </div>
        </li>
    @endforelse
</ul>