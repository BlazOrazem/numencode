<ul class="nestable-list">
    @forelse($collection as $page)
        @include('admin::pages.tree.structure-item')
    @empty
        <li class="nestable-item">
            <div class="nestable-handle">
                <div class="left">
                    <i class="zmdi zmdi-folder-outline"></i>
                    @lang('admin::¸pages.empty')
                </div>
                <div class="right hidden-xs">
                    <div></div>
                    <div></div>
                    <div>
                        @include('admin::components.button.new', [
                            'action' => route('pages.create.menu', ['menu' => $menu]),
                            'icon' => 'zmdi-file-plus'
                        ])
                    </div>
                    <div></div>
                    <div></div>
                </div>
                <div class="right visible-xs"></div>
            </div>
        </li>
    @endforelse
</ul>