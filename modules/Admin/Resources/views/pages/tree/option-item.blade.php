<option value="{{ $pageElement->id }}"
        style="padding-left: {{ $level*10 }}px; text-indent: {{ $level*10 }}px;"
{{--        {{ isset($page) && $pageElement->id == $page->parent_id ? 'selected' : '' }}--}}
        {{ isset($selected) && $selected == $pageElement->id ? 'selected' : '' }}
        >
    {{ $pageElement->title }}
</option>

@if(isset($pageStructure[$pageElement->id]))
    @include('admin::pages.tree.option-list', [
        'pageCollection' => $pageStructure[$pageElement->id],
        'level' => ++$level,
    ])
@endif