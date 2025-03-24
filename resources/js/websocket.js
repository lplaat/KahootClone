let socket;
function messageRouter(event) {
    let data = JSON.parse(event.data);
    if(data['type'] == 'loadPage') {
        sendCommand(socket, 'loadPage', {
            'name': data['data']['name'],
            'values': data['data']['values']
        })
    } else if(data['type'] == 'renderPage') {
        $('#mainContent').html(data['data']);
        $('.hide-when-connected').hide();
    }
}

function sendCommand(ws, type, data) {
    ws.send(JSON.stringify({
        'type': type,
        'data': data
    }));
}

function startWebsocket(url) {
    socket = new WebSocket(url);
    socket.onmessage = messageRouter;
    return socket;
}