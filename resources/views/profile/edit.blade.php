@extends('layouts.app')

@section('page-title', __('Login'))
@section('theme-content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card my-4 shadow" style="height: 100%">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card my-4 shadow" style="height: 100%">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
