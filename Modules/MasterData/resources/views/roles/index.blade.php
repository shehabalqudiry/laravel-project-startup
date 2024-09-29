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
                            <td>
                                <a class="btn btn-outline-primary d-inline" href="{{ route('roles.edit', $item->id) }}">Edit</a>
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
                    <form {{ $modalInput['formOptions'] }}>
                        @csrf
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
                            <div class="form-group">
                                <div class="col-12 p-2">



                                    <table class="table table-hover">
                                        <thead>
                                            <tr style="">
                                                <th>Module</th>
                                                <th style="width: 56px;">Create</th>
                                                <th style="width: 56px;">Show</th>
                                                <th style="width: 56px;">Edit</th>
                                                <th style="width: 56px;">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($options['permissions'] as $permission)
                                                @php
                                                    $sub_permissions = \Spatie\Permission\Models\Permission::where(
                                                        'module',
                                                        $permission->module,
                                                    )->get();
                                                @endphp
                                                <tr>



                                                    <td>{{ $permission->module }}</td>

                                                    @if ($sub_permissions->where('name', 'create-' . $permission->module)->first())
                                                        <td style="width: 56px;">

                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input create" type="checkbox"
                                                                    id="{{ 'create-' . $permission->module }}"
                                                                    value="{{ 'create-' . $permission->module }}"
                                                                    @if (isset($role) && $role->hasPermissionTo('create-' . $permission->module)) checked @endif
                                                                    name="permissions[]">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td style="width: 56px;">
                                                        </td>
                                                    @endif
                                                    @if ($sub_permissions->where('name', 'read-' . $permission->module)->first())
                                                        <td style="width: 56px;">

                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input read" type="checkbox"
                                                                    id="{{ 'read-' . $permission->module }}"
                                                                    value="{{ 'read-' . $permission->module }}"
                                                                    @if (isset($role) && $role->hasPermissionTo('read-' . $permission->module)) checked @endif
                                                                    name="permissions[]">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td style="width: 56px;">
                                                        </td>
                                                    @endif
                                                    @if ($sub_permissions->where('name', 'update-' . $permission->module)->first())
                                                        <td style="width: 56px;">

                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input update" id="flexSwitchCheckChecked"
                                                                    type="checkbox"
                                                                    id="{{ 'update-' . $permission->module }}"
                                                                    value="{{ 'update-' . $permission->module }}"
                                                                    @if (isset($role) && $role->hasPermissionTo('update-' . $permission->module)) checked @endif
                                                                    name="permissions[]">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td style="width: 56px;">
                                                        </td>
                                                    @endif
                                                    @if ($sub_permissions->where('name', 'delete-' . $permission->module)->first())
                                                        <td style="width: 56px;">

                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input delete" type="checkbox"
                                                                    id="{{ 'delete-' . $permission->module }}"
                                                                    value="{{ 'delete-' . $permission->module }}"
                                                                    @if (isset($role) && $role->hasPermissionTo('delete-' . $permission->module)) checked @endif
                                                                    name="permissions[]">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td style="width: 56px;">
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</
                                        button>
                                    @foreach ($modalInput['data'] as $key => $input)
                                        @if ($input['isButton'])
                                            <button type="{{ $input['type'] }}"
                                                class="btn btn-outline-primary">{{ $input['label'] }}</button>
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
