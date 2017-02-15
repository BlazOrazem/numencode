@foreach ($elements as $item)

    @php ($itemName = $item->name)

    @if ($item->type == 'text')
        <div class="form-group">
            <label class="control-label col-sm-3">
                {{ $item->label }}
            </label>
            <div class="col-sm-9">
                <input type="text" name="params[{{ $itemName }}]" value="{{ isset($data->$itemName) ? $data->$itemName : '' }}" class="form-control">
            </div>
        </div>
    @endif

    @if ($item->type == 'select')
        <div class="form-group">
            <label class="control-label col-sm-3">
                {{ $item->label }}
            </label>
            <div class="col-sm-9">
                <select name="params[{{ $itemName }}]" class="form-control selectpicker">
                    @foreach($item->options as $key => $option)
                        <option value="{{ $key }}" {{ isset($data->$itemName) && $data->$itemName == $key ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

@endforeach