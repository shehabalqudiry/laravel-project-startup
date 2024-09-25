@extends('layouts.app')
@section('page-title', $options['page_title'] ?? 'Dashboard')
@section('theme-content')
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
    <div class="row">
        <div class="col-12 col-lg-6 text-center">
            <div class="card shadow">
                <div class="card-header">
                    {{ __('Create New Role') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $options['role']->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="displayName">{{ __('Display Name') }}</label>
                            <input type="text" class="form-control" value="{{ old('display_name', $options['role'] ?? "") }}"
                                id="displayName" name="display_name">
                        </div>
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



                                                <td>{{ str_replace('_', ' ', ucwords($permission->module)) }}</td>

                                                @if ($sub_permissions->where('name', 'create-' . $permission->module)->first())
                                                    <td style="width: 56px;">

                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input create" type="checkbox"
                                                                id="{{ 'create-' . $permission->module }}"
                                                                value="{{ 'create-' . $permission->module }}"
                                                                @if (isset($options['role']) && $options['role']->hasPermissionTo('create-' . $permission->module)) checked @endif
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
                                                                @if (isset($options['role']) && $options['role']->hasPermissionTo('read-' . $permission->module)) checked @endif
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
                                                                type="checkbox" id="{{ 'update-' . $permission->module }}"
                                                                value="{{ 'update-' . $permission->module }}"
                                                                @if (isset($options['role']) && $options['role']->hasPermissionTo('update-' . $permission->module)) checked @endif
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
                                                                @if (isset($options['role']) && $options['role']->hasPermissionTo('delete-' . $permission->module)) checked @endif
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-link">{{ __('Cancel') }}</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
