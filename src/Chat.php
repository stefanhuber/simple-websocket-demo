<?php

namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->sendMessageToAll("CHAT-INFO: New User in Chatroom");
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $message)
    {

        $this->sendMessageToAll($message);
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        $this->sendMessageToAll("CHAT-INFO: User left Chatroom");
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    public function sendMessageToAll($message)
    {
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
}