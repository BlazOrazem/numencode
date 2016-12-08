<li class="nestable-item">
    <div class="nestable-handle" style="display: flex; justify-content: space-between;">
        <div class="left">
            <i class="zmdi zmdi-{{ isset($menu[$item->id]) ? 'folder' : 'file-text' }}"></i>
            {{ $item->title }}
        </div>
        <div class="right">
            <div class="checkbox checkbox-primary">
                <label><input type="checkbox" checked><i></i></label>
            </div>
            <a href="#" class="btn btn-info">
                <i class="zmdi zmdi-edit"></i>
            </a>
            <a href="#" class="btn btn-info">
                <i class="zmdi zmdi-delete"></i>
            </a>
        </div>
    </div>
    @if (isset($menu[$item->id]))
        @include ('admin::pages.structure-list', ['collection' => $menu[$item->id]])
    @endif
</li>