@php($inline = isset($inline))

<div class="form-group">

    @if(!$inline)
        <div class="col-sm-9 col-sm-offset-3">
    @endif

        <button type="submit" value="save" class="btn btn-md btn-success submit">
            @lang('admin::forms.buttons.save')
        </button>
        <button type="submit" class="btn btn-md btn-info submit">
            @lang('admin::forms.buttons.return')
        </button>
        <a href="{{ $cancel ?? route('pages.index') }}" class="btn btn-md btn-default btn-link">
            @lang('admin::forms.buttons.cancel')
        </a>

    @if($inline)
        <span class="help-block"></span>
    @else
        </div>
    @endif

</div>