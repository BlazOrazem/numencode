<div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
    <label for="{{ $fieldId = 'order-' . str_random(10) }}" class="col-sm-2 control-label">{{ trans('admin::forms.order_label') }}</label>
    <div class="col-sm-10">
        <input type="text" name="sort_order" value="{{ old('sort_order', $next) }}" class="form-control{{ isset($class) ? ' ' . $class : '' }}" id="{{ $fieldId }}" placeholder="{{ trans('admin::forms.order_placeholder') }}">
        <p class="help-block">{{ $errors->first('sort_order', ':message') }}</p>
    </div>
</div>