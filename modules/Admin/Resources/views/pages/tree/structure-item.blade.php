<li class="nestable-item">
    <div class="nestable-handle">
        <div class="left{{ isset($tree[$page->id]) ? ' drop' : '' }}">
            <i class="zmdi zmdi-{{ isset($tree[$page->id]) ? 'folder' : 'file-text' }}"></i>
            <a href="{{ route('pages.edit', compact('page')) }}">{{ $page->title }}</a>
        </div>
        <div class="right hidden-xs">
            <div class="text-right">
                <label class="switch">
                    <input class="toggle toggle-info"
                           type="checkbox"
                           name="toggle"
                           data-toggle="{{ route('pages.active', [$page->id]) }}"
                            {{ $page->is_hidden ? '' : 'checked' }}
                            >
                    <i></i>
                </label>
            </div>
            <div>
                @if(config('numencode.page.max_depth') >= $level)
                    @include('admin::components.button.new', [
                        'action' => route('pages.create.page', ['page' => $page]),
                        'icon' => 'zmdi-file-plus'
                    ])
                @endif
            </div>
            <div>@include('admin::components.button.edit', ['action' => route('pages.edit', compact('page'))])</div>
            <div>
                @include('admin::components.button.delete', [
                    'action' => route('pages.destroy', compact('page')),
                    'htmlItem' => 'li.nestable-item',
                ])
            </div>
        </div>
        <div class="right visible-xs"></div>
    </div>
    @if(isset($tree[$page->id]))
        @include('admin::pages.tree.structure-list', ['collection' => $tree[$page->id], 'level' => ++$level])
    @endif
</li>