<x-app-layout>
    <div class="hide-when-connected">
        <div class="mt-5 d-flex justify-content-center align-item-center">
            <div>
                <h1>The quiz is getting started</h1>
            </div>
        </div>
    </div>
    
    <div id="mainContent">

    </div>
</x-app-layout>

<script>
    const ws = startWebsocket('<?= env('WEBSOCKET_URL') ?>');

    ws.onopen = function () {
        sendCommand(ws, 'createRoom', {
            'quiz_id': <?= $quiz->id ?>
        });
    }
</script>