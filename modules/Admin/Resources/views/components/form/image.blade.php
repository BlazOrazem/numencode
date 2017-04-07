@php($inline = isset($inline))
@php($fieldId = camel_case($field) . '-' . str_random(10))

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">

    @if(isset($label))
        <label for="{{ $fieldId }}" class="control-label{{ !$inline ? ' col-sm-3' : '' }}">
            {{ $label }}
        </label>
    @endif

    @if(!$inline)
        <div class="col-sm-9">
    @endif

        <input type="file"
               name="{{ $field }}"
               class="form-control{{ isset($class) ? ' ' . $class : '' }}"
               id="{{ $fieldId }}"
                >
        <span class="help-block">
            {!! isset($help) ? $help . '</br>' : '' !!}
            {{ $errors->first($field, ':message') }}
        </span>

        @if(isset($entity) && $entity->$field)
            <br class="clearfix">
            <img src="{{ $entity->$field }}" class="img-responsive img-thumbnail" width="250">
        @endif

    @if(!$inline)
        </div>
    @endif

</div>