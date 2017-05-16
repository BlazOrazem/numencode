@php($inline = isset($inline))
@php($required = isset($required))
@php($fieldId = camel_case($field) . '-' . str_random(10))

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
    @else
        @if(isset($entity) && $entity->$field)
            <img src="{{ $entity->$field }}" class="img-thumbnail" style="height: 44px;">
        @endif
    @endif

            <input type="file"
                   name="{{ $field }}"
                   value="{{ old($field) }}"
                   class="form-control{{ isset($class) ? ' ' . $class : '' }}"
                   id="{{ $fieldId }}"
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
        @if(isset($entity) && $entity->$field)
            <img src="{{ $entity->$field }}" class="img-responsive img-thumbnail" style="max-height: 300px;">
            <br class="clearfix"><br />
        @endif

        </div>
    @endif

</div>