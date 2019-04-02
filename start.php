<?php

require_once __DIR__ . '/vendor/autoload.php';

$server = \Ratchet\Server\IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new \App\Chat()
        )
    ) ,
    9080
);

$server->run();
