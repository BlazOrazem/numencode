<li data-jstree='{"type":"{{ isset($pageTree[$page->id]) ? 'folder' : 'page' }}"}'>
    <span title="{{ $page->title }}" onclick="javascript:location.href='#'">{{ $page->title }}</span>
    @if (isset($pageTree[$page->id]))
        @include ('admin::pages.list', ['collection' => $pageTree[$page->id]])
    @endif
</li>