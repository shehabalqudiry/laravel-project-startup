@extends('layouts.app')

@section('theme-content')
    @if (in_array('page_title', $options))
        <h1 class="page-title">{{ $options['page_title'] }}</h1>
    @endif
    @if (session()->has('done'))
        <div class="mb-3 alert alert-success" role="alert">
            {{ session()->get('done') }}
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="mb-3 alert alert-danger" role="alert">
            {{ session()->get('fail') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-3 alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br />
            @endforeach
        </div>
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
                                    @foreach ($options['actions'] as $actionKey => $action)
                                        <x-table-action-button-component :b_text="$action['label']" :b_class="$action['class']"
                                            :b_href="$action['href']" :modal_id="'modal-' . $actionKey . '-' . $item->id" :options="$options" :action="'action=' . route($action['action_route'], $item->id)" :item="$item" :columns="$options['columns']"></x-table-action-button-component>
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
                            <h5 class="modal-title" id="modalLabel">{{ $modalInput['modalName'] }}</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($modalInput['data'] as $key => $input)
                                <div class="form-group">
                                    @if (!$input['isButton'])
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        <input type="{{ $input['type'] }}" class="form-control"
                                            value="{{ old($input['name']) }}" id="{{ $input['name'] }}"
                                            name="{{ $input['name'] }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</ button>
                                @foreach ($modalInput['data'] as $key => $input)
                                    @if ($input['isButton'])
                                        <button type="{{ $input['type'] }}"
                                            class="btn btn-outline-primary">{{ $input['label'] }}</button>
                                    @endif
                                @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
