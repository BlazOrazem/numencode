<option value="{{ $pageElement->id }}"
        class="nested-option"
        style="padding-left: {{ $level*10 }}px; text-indent: {{ $level*10 }}px;"
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