@php ($inlineForm = isset($inline))

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">

    <label for="{{ $fieldId = camel_case($label) . '-' . str_random(10) }}"
           class="control-label @if (!$inlineForm)col-sm-3 @endif"
            >
        {{ $label }}
    </label>

    @if (!$inlineForm)<div class="col-sm-9"> @endif

        <input type="text"
               name="{{ $field }}"
               value="{{ old($field, (isset($entity) ? $entity->$field : '')) }}"
               class="form-control{{ isset($class) ? ' ' . $class : '' }}"
               id="{{ $fieldId }}"
               placeholder="{{ $placeholder }}"
                >
        <span class="help-block">
            {{ $errors->first($field, ':message') }}
        </span>

    @if (!$inlineForm)</div> @endif

</div>