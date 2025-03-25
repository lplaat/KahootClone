<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="d-flex justify-content-center align-items-center vh-100 hide-when-connected">
        <div class="text-center w-25 bg-light-subtle p-4 rounded">
            <?php if(Auth::id() == null){ ?>
                <a href="/login" class="position-absolute btn btn-light" style="top: 15px; right: 20px;">login</a>
            <?php } ?>

            <x-application-logo />

            <x-text-input id="code" class="block mt-3 w-full" type="text" name="code" required autofocus autocomplete="username" placeholder="Enter the room code" />
            <span class="text-danger error-message d-none"></span>

            <div class="mt-3 px-2">
                <button class="btn btn-primary" onclick="joinRoom()">
                    <b>Join</b>
                </button>
            </div>
        </div>
    </div>

    <div id="mainContent"></div>

    <script>
        function joinRoom() {
            let response = connectToRoom($('#code').val(), '<?= env('WEBSOCKET_URL') ?>');
            if(!response[0]) {
                $('.error-message').removeClass('d-none');
                $('.error-message').html(response[1]);
            }
        }
    </script>
</x-app-layout>
