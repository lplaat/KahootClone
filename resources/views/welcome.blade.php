<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST">
        @csrf
        <a href="/login" class="text-gray-100 absolute right-10 top-5 bg-gray-200 hover:bg-white text-gray-800 p-1 rounded">login</a>
        <!-- Email Address -->
        <div>
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus autocomplete="username" placeholder="Vul de speelpin in" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('starten') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
