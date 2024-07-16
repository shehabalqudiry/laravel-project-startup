@extends('layouts.app')

@section('theme-content')
    @if (in_array('page_title', $options))
        <h1 class="page-title">{{ $options['page_title'] }}</h1>
    @endif
    <div class="card shadow">
        <div class="card-header">
            @if (in_array('headerButtons', $options))
                @foreach ($options['headerButtons'] as $button)
                    <h3 class="card-title">{!! $button !!}</h3>
                @endforeach
            @endif
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover table-borderless">
                <thead>
                    <tr>
                        @foreach ($options['columns'] as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                        @if ($options['actions'] != [])
                            <th>{{ __('Actions') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            @foreach ($options['columns'] as $columnKey => $column)
                                <td>{{ $item->{$columnKey} }}</td>
                            @endforeach

                            @if ($options['actions'] != [])
                                <td>
                                    @foreach ($options['actions'] as $action)
                                        {!! $action !!}
                                    @endforeach
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{--  make modal bootstrap 4  --}}
    @foreach ($options['modalInputs'] as $modalInput)
        <div class="modal fade" id="{{ $modalInput['modalId'] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form {{ $modalInput['formOptions'] }}>
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($modalInput['data'] as $key => $input)
                                <div class="form-group">
                                    @if (!$input['isButton'])
                                        <label for="{{ $input['name'] }}">{{ $input['lable'] }}</label>
                                        <input type="{{ $input['type'] }}" class="form-control"
                                            value="{{ old($input['name']) }}" id="{{ $input['name'] }}"
                                            name="{{ $input['name'] }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</ button>
                                @foreach ($modalInput['data'] as $key => $input)
                                    @if ($input['isButton'])
                                        <button type="{{ $input['type'] }}"
                                            class="btn btn-primary">{{ $input['lable'] }}</button>
                                    @endif
                                @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
