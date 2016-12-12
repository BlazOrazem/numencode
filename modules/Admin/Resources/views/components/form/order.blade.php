@php ($inlineForm = isset($inline))
@php ($fieldId = 'sort_order-' . str_random(10))

<div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">

    <label for="{{ $fieldId }}" class="control-label @if (!$inlineForm)col-sm-3 @endif">
        @lang('admin::forms.order_label')
    </label>

    @if (!$inlineForm)<div class="col-sm-9"> @endif

        <input type="text"
               name="sort_order"
               value="{{ old('sort_order', isset($sortOrder) ? $sortOrder : 0) }}"
               class="form-control{{ isset($class) ? ' ' . $class : '' }}"
               id="{{ $fieldId }}"
               placeholder="@lang('admin::forms.order_placeholder')"
                >
        <span class="help-block">
            {{ $errors->first('sort_order', ':message') }}
        </span>

    @if (!$inlineForm)</div> @endif

</div>