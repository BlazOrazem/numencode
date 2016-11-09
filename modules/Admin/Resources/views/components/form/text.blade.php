@php ($inlineForm = isset($inline))

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

    <label for="{{ $fieldId = camel_case($label) . '-' . str_random(10) }}"
           class="control-label @if (!$inlineForm)col-sm-2 @endif"
            >
        {{ $label }}
    </label>

    @if (!$inlineForm)<div class="col-sm-10"> @endif

        <input type="text" name="{{ $field }}"
               value="{{ old($field, (isset($item) ? $item->$field : '')) }}"
               class="form-control{{ isset($class) ? ' ' . $class : '' }}"
               id="{{ $fieldId }}"
               placeholder="{{ $placeholder }}"
                >
        <span class="help-block">
            {{ $errors->first($field, ':message') }}
        </span>

    @if (!$inlineForm)</div> @endif

</div>