<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center w-25 bg-light-subtle p-4 rounded">
            <form method="POST" class="">
                @csrf
                <a href="/login" class="position-absolute btn btn-light" style="top: 15px; right: 20px;">login</a>
                <x-application-logo />
                <!-- Email Address -->
                <div>
                    <x-text-input id="code" class="block mt-3 w-full" type="text" name="code" required autofocus autocomplete="username" placeholder="Vul de speelpin in" />
                </div>

                <div class=" mt-3">
                    <x-primary-button class="btn btn-primary">
                        {{ __('starten') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>  

   
    
</x-app-layout>
