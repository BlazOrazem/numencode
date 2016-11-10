@php ($inlineForm = isset($inline))

<div class="form-group">

    @if (!$inlineForm)<div class="col-sm-9 col-sm-offset-3">@endif

        <button type="submit" class="btn btn-md btn-{{ isset($type) ? $type : 'success' }}">
            {{ isset($button) ? $button : trans('admin::forms.submit') }}
        </button>

    @if ($inlineForm)
        <span class="help-block"></span>
    @else
        </div>
    @endif

</div>