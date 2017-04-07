@php($inline = isset($inline))
@php($checked = isset($checked))
@php($fieldId = camel_case($field) . '-' . str_random(10))

<div class="form-group">

    @if(isset($label))
        <label for="{{ $fieldId }}" class="control-label{{ !$inline ? ' col-sm-3' : '' }}">
            {{ $label }}
        </label>
    @endif

    @if(!$inline)
        <div class="col-sm-9">
    @endif

        <div class="checkbox checkbox-alt checkbox-{{ isset($type) ? $type : 'base' }}">
            <label>
                <input type="checkbox" value="1" name="{{ $field }}"{{ $checked ? ' checked' : '' }}>
                <i></i>
            </label>
        </div>

    @if(!$inline)
        </div>
    @endif

</div>