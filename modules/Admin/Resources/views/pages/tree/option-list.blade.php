@foreach($pageCollection as $pageElement)
    @if(config('numencode.page.max_depth') >= $level)
        @include('admin::pages.tree.option-item')
    @endif
@endforeach