<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <x-splade-form method="put" :action="route('password.update')" class="mt-6 space-y-6" preserve-scroll>
        <div class="grid grid-cols-3 gap-4">
            <x-splade-input class="col-span-3 md:col-span-1" id="current_password" name="current_password" type="password" :label="__('Current Password')" autocomplete="current-password" />
            <x-splade-input class="col-span-3 md:col-span-1" id="password" name="password" type="password" :label="__('New Password')" autocomplete="new-password" />
            <x-splade-input class="col-span-3 md:col-span-1" id="password_confirmation" name="password_confirmation" type="password" :label="__('Confirm Password')" autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Save')" />

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </x-splade-form>
</section>
