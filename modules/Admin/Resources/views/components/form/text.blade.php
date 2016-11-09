<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="{{ $fieldId = camel_case($label) . '-' . str_random(10) }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-10">
        <input type="text" name="{{ $field }}" value="{{ old($field) }}" class="form-control{{ isset($class) ? ' ' . $class : '' }}" id="{{ $fieldId }}" placeholder="{{ $placeholder }}">
        <span class="help-block">{{ $errors->first($field, ':message') }}</span>
    </div>
</div>