<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('admin.verification.send') }}">
        @csrf
    </form>
    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('patch')
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="name" class="form-control {{ $errors->get('name') ? 'is-invalid' : '' }}"
                value="{{ old('name', $user ?? '') }}" required autofocus autocomplete="name"
                placeholder="{{ __('Name') }}" />
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger font-2" />
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="email" class="form-control {{ $errors->get('email') ? 'is-invalid' : '' }}"
                value="{{ old('email', $user ?? '') }}" required autocomplete="username"
                placeholder="{{ __('Email') }}" />
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger font-2" />
        </div>
        
        <button class="btn btn-block btn-primary shadow-md mt-2" type="submit">{{ __('Save') }}</button>
        <div class="flex items-center mt-3">
            @if (session('status') === 'profile-updated')
                <div class="alert alert-light-success color-success alert-dismissible show fade">
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                        <i class="bi bi-check-circle"></i>
                        {{ __('Profile updated successfully') }}
                    </p>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
        </div>
    </form>
</section>
