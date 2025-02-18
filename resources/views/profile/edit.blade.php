<x-app-layout>
    <x-slot name="header">
        <h2 class="p-3 mb-0">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="p-3">
        <div>
            <div class="bg-light-subtle p-3 rounded">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-light-subtle p-3 rounded mt-3">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-light-subtle p-3 rounded mt-3">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
