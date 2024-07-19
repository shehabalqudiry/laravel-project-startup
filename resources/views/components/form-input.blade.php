@php
    $type = $input['type'];
@endphp

<label for="{{ $input['name'] }}">{{ $input['label'] }}</label>

@if ($type === 'textarea')
    <textarea class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}">{{ $old }}</textarea>
@elseif ($type === 'select')
    <select class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}">
        @foreach ($input['options'] as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ $old == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
@elseif ($type === 'multiple')
    <select class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}[]" multiple>
        @foreach ($input['options'] as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ in_array($optionValue, $old) ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
@elseif (str_contains($old, 'upload/'))
    <span><img src="{{ asset($old) }}" width="70px" alt="image"></span>
    <br>
    <input type="{{ $type }}" class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}">
@else
    <input type="{{ $type }}" class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}" value="{{ $old }}">
@endif
