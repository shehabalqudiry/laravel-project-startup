@extends('layouts.guest')

@section('page-title', __('Login'))
@section('theme-content')
    <style>
        #auth #auth-right {
            background-color: #005f85 !important;
            padding: 0 200px;
        }

        #auth #auth-right #image {
            background-image: url({{ $settings['app_logo'] }}) !important;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('admin.dashboard') }}"><img src="{{ $settings['app_logo'] }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5"></p>

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="email" class="form-control form-control-xl {{ $errors->get('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                                placeholder="{{ __('Email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger font-2" />
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl {{ $errors->get('password') ? 'is-invalid' : '' }}"
                                placeholder="{{ __('Password') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger font-2" />
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" name="remember_me" type="checkbox" value=""
                                id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
                            type="submit">{{ __('Log in') }}</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold" href="{{ route('admin.password.email') }}">{{ __('Forgot your password?') }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <div id="image">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
