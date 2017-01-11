@php ($inlineForm = isset($inline))
@php ($fieldId = camel_case($field) . '-' . str_random(10))

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">

    @if (isset($label))
        <label for="{{ $fieldId }}" class="control-label @if (!$inlineForm)col-sm-3 @endif">
            {{ $label }}
        </label>
    @endif

    @if (!$inlineForm)<div class="col-sm-9"> @endif

        <select name="{{ $field }}"
                id="{{ $fieldId }}"
                class="form-control selectpicker{{ isset($class) ? ' ' . $class : '' }}"
                data-style="{{ isset($style) ? 'btn-' . $style : 'btn-info' }}"
                @if (isset($dataAttribute))
                    {!! $dataAttribute !!}
                @endif
                >
            @if (isset($placeholder))
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach($data as $selectItem)
            <option value="{{ $selectItem->id }}">{{ $selectItem->title }}</option>
            @endforeach
        </select>

        <span class="help-block">
            {!! isset($help) ? $help . '</br>' : '' !!}
            {{ $errors->first($field, ':message') }}
        </span>

        @if (!$inlineForm)</div> @endif

</div>