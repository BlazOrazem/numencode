@foreach ($data as $item)
    @if ($item->type == 'text')
        <div class="form-group">
            <label class="control-label col-sm-3">
                {{ $item->label }}
            </label>
            <div class="col-sm-9">
                <input type="text" name="params[{{ $item->name }}]" class="form-control">
            </div>
        </div>
    @endif
    @if ($item->type == 'select')
        <div class="form-group">
            <label class="control-label col-sm-3">
                {{ $item->label }}
            </label>
            <div class="col-sm-9">
                <select name="params[{{ $item->name }}]" class="form-control selectpicker">
                    @foreach($item->options as $key => $option)
                        <option value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
@endforeach