@php ($inlineForm = isset($inline))
@php ($fieldId = camel_case($field) . '-' . str_random(10))

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">

    @if (isset($label))
        <label for="{{ $fieldId }}" class="control-label @if (!$inlineForm)col-sm-3 @endif">
            {{ $label }}
        </label>
    @endif

    @if (!$inlineForm)<div class="col-sm-9"> @endif

        <input type="text"
               name="{{ $field }}"
               value="{{ old($field, (isset($entity) ? $entity->$field : '')) }}"
               class="form-control{{ isset($class) ? ' ' . $class : '' }}"
               id="{{ $fieldId }}"
               placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
                >
        <span class="help-block">
            {{ $errors->first($field, ':message') }}
        </span>

    @if (!$inlineForm)</div> @endif

</div>