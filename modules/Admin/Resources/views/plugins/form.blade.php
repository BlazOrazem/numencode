@foreach ($params as $key => $param)
    @if ($param == 'text')
        <div class="form-group">
            <label class="control-label col-sm-3">
                {{ $key }}
            </label>
            <div class="col-sm-9">
            <input type="text" name="params[{{ $key }}]" class="form-control">
            </div>
        </div>
    @endif
@endforeach