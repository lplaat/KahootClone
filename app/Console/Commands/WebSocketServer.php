<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use React\EventLoop\Loop;
use React\Socket\SocketServer;
use App\Http\Controllers\RoomController;

class WebSocketServer extends Command implements MessageComponentInterface
{
    protected $signature = 'websocket:serve';
    protected $description = 'Start the WebSocket server';
    protected $clients;

    public function __construct()
    {
        parent::__construct();
        $this->clients = new \SplObjectStorage;
    }

    public function handle()
    {
        $loop = Loop::get();

        $server = new IoServer(
            new HttpServer(
                new WsServer($this)
            ),
            new SocketServer(env('WEBSOCKET_HOST') . ':' . env('WEBSOCKET_PORT'), [], $loop),
            $loop
        );

        $this->info("WebSocket server started on " . env('WEBSOCKET_URL'));
        $loop->run();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $request = json_decode($msg, true);
        if($request['type'] == 'createRoom') {
            RoomController::createRoom($request, $from);
        } else if($request['type'] == 'loadPage') {
            RoomController::loadPage($request, $from);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} closed\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}
