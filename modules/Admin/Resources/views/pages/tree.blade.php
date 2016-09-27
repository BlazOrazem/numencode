<li data-jstree='{"type":"{{ (count($page->children) > 0) ? 'folder' : 'page' }}"}'>
    <span title="{{ $page->title }}" onclick="javascript:location.href='#'">{{ $page->title }}</span>
    @if (count($page->children) > 0)
        <ul>
            @foreach($page->children as $page)
                @include('admin::pages.tree', $page)
            @endforeach
            <li data-jstree='{"type":"new"}'>
                <span onclick="javascript:location.href='#'">New page</span>
            </li>
        </ul>
    @endif
</li>