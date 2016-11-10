@php ($inlineForm = isset($inline))

<div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">

    <label for="{{ $fieldId = 'order-' . str_random(10) }}"
           class="control-label @if (!$inlineForm)col-sm-3 @endif"
            >
        {{ trans('admin::forms.order_label') }}
    </label>

    @if (!$inlineForm)<div class="col-sm-9"> @endif

        <input type="text"
               name="sort_order"
               value="{{ old('sort_order', $next) }}"
               class="form-control{{ isset($class) ? ' ' . $class : '' }}"
               id="{{ $fieldId }}"
               placeholder="{{ trans('admin::forms.order_placeholder') }}"
                >
        <span class="help-block">
            {{ $errors->first('sort_order', ':message') }}
        </span>

    @if (!$inlineForm)</div> @endif

</div>