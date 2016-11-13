@php ($inlineForm = isset($inline))
@php ($fieldId = camel_case($field) . '-' . str_random(10))

<div class="form-group">

    @if (isset($label))
        <label for="{{ $fieldId }}" class="control-label @if (!$inlineForm)col-sm-3 @endif">
            {{ $label }}
        </label>
    @endif

    @if (!$inlineForm)<div class="col-sm-9"> @endif

        <div class="checkbox checkbox-alt checkbox-{{ isset($type) ? $type : 'success' }}">
            <label>
                <input type="checkbox" name="{{ $field }}" {{ isset($isChecked) && $isChecked == true ? 'checked' : '' }}>
                <i></i>
            </label>
        </div>

    @if (!$inlineForm)</div> @endif

</div>