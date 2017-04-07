<li class="nestable-item">
    <div class="nestable-handle">
        <div class="left{{ isset($menu[$item->id]) ? ' drop' : '' }}">
            <i class="zmdi zmdi-{{ isset($menu[$item->id]) ? 'folder' : 'file-text' }}"></i>
            <a href="#">{{ $item->title }}</a>
        </div>
        <div class="right hidden-xs">
            <div class="checkbox checkbox-primary">
                <label><input type="checkbox" checked><i></i></label>
            </div>
            <div>
                @if(config('numencode.page.max_depth') >= $level)
                    @include('admin::components.button.new', [
                        'action' => route('home'),
                        'icon' => 'zmdi-file-plus'
                    ])
                @endif
            </div>
            <div>@include('admin::components.button.edit', ['action' => route('home')])</div>
            <div>@include('admin::components.button.delete', ['action' => route('home')])</div>
        </div>
        <div class="right visible-xs"></div>
    </div>
    @if(isset($menu[$item->id]))
        @include('admin::pages.structure-list', ['collection' => $menu[$item->id], 'level' => ++$level])
    @endif
</li>