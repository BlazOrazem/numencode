@php($inline = isset($inline))
@php($required = isset($required))
@php($fieldId = Str::camel($field) . '-' . Str::random(10))

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}{{ $required ? ' has-icon' : '' }}">

    @if(isset($label))
        <label for="{{ $fieldId }}" class="control-label{{ !$inline ? ' col-sm-3' : '' }}">
            {{ $label }}
        </label>
    @endif

    @if(!$inline)
        <div class="col-sm-9">
    @endif

        <select name="{{ $field }}"
                id="{{ $fieldId }}"
                class="form-control selectpicker{{ isset($class) ? ' ' . $class : '' }}"
                data-style="{{ isset($style) ? 'btn-' . $style : 'btn-info' }}"
                @if(isset($dataAttribute))
                    {!! $dataAttribute !!}
                @endif
                >

            @if(isset($placeholder))
                <option value="">{{ $placeholder }}</option>
            @endif

            @if(isset($params))
                @php($selectItemValue = reset($params))
                @php($selectItemTitle = end($params))
            @else
                @php($selectItemValue = 'id')
                @php($selectItemTitle = 'title')
            @endif

            @foreach($data as $selectItem)
                <option value="{{ $selectItem->$selectItemValue }}"
                        {{ isset($selected) && $selected == $selectItem->$selectItemValue ? 'selected' : '' }}
                        >{{ $selectItem->$selectItemTitle }}</option>
            @endforeach
        </select>

        @if($required)
            <span class="zmdi zmdi-star-outline f-s-18 form-icon"></span>
        @endif

        <span class="help-block">
            {!! isset($help) ? $help . '</br>' : '' !!}
            {{ $errors->first($field, ':message') }}
        </span>

    @if(!$inline)
        </div>
    @endif

</div>