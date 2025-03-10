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
            new SocketServer('0.0.0.0:3000', [], $loop),
            $loop
        );

        $this->info("WebSocket server started on ws://127.0.0.1:3000");
        $loop->run();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Message received: $msg\n";
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
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
