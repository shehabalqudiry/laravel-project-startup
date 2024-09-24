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
    <div class="shadow card">
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
                                <td>{!! $item->{$columnKey} !!}</td>
                            @endforeach
                            <td>
                                <x-button class="d-inline" :item="$item" :action="'action=' . route($options['updateRoute'], $item->id)" :options="$options">Edit
                                </x-button>
                                <x-button-delete class="d-inline" :item="$item" :action="'action=' . route($options['deleteRoute'], $item->id)"
                                    :options="$options">Delete
                                </x-button-delete>
                            </td>
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
                    <form {{ $modalInput['formOptions'] }} >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"> {{ $modalInput['modalName'] }} </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($modalInput['data'] as $key => $input)
                                @if( $input['type'] == 'checkbox')
                                <div class="form-check form-switch">
                                    <div class="form-check">
                                        <label for="" class="@if( $input['type'] == 'checkbox') form-check-label @endif">{{ $input['label'] }}</label>
                                        <input name="{{ $input['name'] }}" hidden value="0">
                                        <input class="form-check-input " type="checkbox" checked="true" name="{{ $input['name'] }}" id="{{ $key }}" value="1" >
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    {{-- normal input --}}
                                    @if (!in_array($input['tagtype'], ['multiple', 'select', 'textarea', 'checkbox']) and !$input['isButton'])
                                        <label for="{{ $input['name'] }}"  class="form-label">{{ $input['label'] }}</label>
                                        @if ($input['name'] == 'images[]')
                                            <small class="form-control form-text text-muted">Please upload exactly more
                                                one images.</small>
                                            <input type="file" class="form-control" id="images"
                                                name="{{ $input['name'] }}" {{ $input['required'] }} multiple>
                                        @else
                                            <input type="{{ $input['type'] }}" class="form-control {{ $input['additional_class'] ?? '' }}"
                                                value="{{ old($input['name']) }}" id="{{ $input['name'] }}"
                                                name="{{ $input['name'] }}" {{ $input['required'] }} placeholder="{{ $input['placeholder'] }}">
                                        @endif
                                        {{-- multiple --}}
                                    @elseif ($input['tagtype'] == 'select' and !$input['isButton'])
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        <select class="form-control " value="{{ old($input['name']) }}" {{ $input['required'] }}
                                            id="{{ $input['name'] }}" name="{{ $input['name'] }}">
                                            @foreach ($input['optionsdata'] as $itemlist)
                                                <option value="{{ $itemlist->id }}">{{ $itemlist->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- textarea --}}
                                    @elseif ($input['tagtype'] == 'textarea' and !$input['isButton'])
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        <textarea class="form-control" {{ $input['required'] }} id="textarea" name="{{ $input['name'] }}" cols="12" rows="6">{{ old($input['name']) }}</textarea>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                var modal = new bootstrap.Modal(document.getElementById('AddModal'), {});
                modal.show();
            @endif
        });
    </script>
@endsection
