{{--  <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>  --}}
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Ensure your account is using a long, random password to stay secure.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('admin.verification.send') }}">
        @csrf
    </form>
    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('patch')
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="current_password" class="form-control {{ $errors->updatePassword->get('current_password') ? 'is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" />
            <div class="form-control-icon">
                <i class="bi bi-lock"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger font-2" />
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password" class="form-control {{ $errors->updatePassword->get('password') ? 'is-invalid' : '' }}" placeholder="{{ __('New Password') }}" />
            <div class="form-control-icon">
                <i class="bi bi-lock"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger font-2" />
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password_confirmation" class="form-control {{ $errors->updatePassword->get('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirm Password') }}" />
            <div class="form-control-icon">
                <i class="bi bi-lock"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger font-2" />
        </div>

        <button class="btn btn-primary btn-block shadow-md mt-2" type="submit">{{ __('Save') }}</button>
        <div class="flex items-center mt-3">
            @if (session('status') === 'password-updated')
                <div class="alert alert-light-success color-success alert-dismissible show fade">
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                        <i class="bi bi-check-circle"></i>
                        {{ __('Password updated successfully') }}
                    </p>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
        </div>
    </form>
</section>
