@php ($inlineForm = isset($inline))
@php ($fieldId = camel_case($field) . '-' . str_random(10))
@php ($required = isset($required) ? true : false)

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}{{ $required ? ' has-icon' : '' }}">

    @if ($inlineForm)<div class="p-relative"> @endif

    @if (isset($label))
        <label for="{{ $fieldId }}" class="control-label @if (!$inlineForm)col-sm-3 @endif">
            {{ $label }}
        </label>
    @endif

    @if (!$inlineForm)<div class="col-sm-9"> @endif
        @if (!$inlineForm)<div class="p-relative"> @endif
            <input type="text"
                   name="{{ $field }}"
                   value="{{ old($field, (isset($entity) ? $entity->$field : '')) }}"
                   class="form-control{{ isset($class) ? ' ' . $class : '' }}"
                   id="{{ $fieldId }}"
                   placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
                    >
            @if ($required)<span class="zmdi zmdi-star-outline f-s-18 form-icon"></span> @endif
        </div>
        <span class="help-block">
            {!! isset($help) ? $help . '</br>' : '' !!}
            {{ $errors->first($field, ':message') }}
        </span>

    @if (!$inlineForm)</div> @endif

</div>