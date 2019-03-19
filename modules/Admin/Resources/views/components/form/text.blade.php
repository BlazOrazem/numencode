@php($inline = isset($inline))
@php($required = isset($required))
@php($fieldId = Str::camel($field) . '-' . Str::random(10))

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}{{ $required ? ' has-icon' : '' }}">

    @if($inline)
        <div class="p-relative">
    @endif

    @if(isset($label))
        <label for="{{ $fieldId }}" class="control-label{{ !$inline ? ' col-sm-3' : '' }}">
            {{ $label }}
        </label>
    @endif

    @if(!$inline)
        <div class="col-sm-9">
            <div class="p-relative">
    @endif

            <input type="text"
                   name="{{ $field }}"
                   value="{{ old($field, (isset($entity) ? $entity->$field : '')) }}"
                   class="form-control{{ isset($class) ? ' ' . $class : '' }}"
                   id="{{ $fieldId }}"
                   placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
                    >
            @if($required)
                <span class="zmdi zmdi-star-outline f-s-18 form-icon"></span>
            @endif
        </div>

        <span class="help-block">
            {!! isset($help) ? $help . '</br>' : '' !!}
            {{ $errors->first($field, ':message') }}
        </span>

    @if(!$inline)
        </div>
    @endif

</div>