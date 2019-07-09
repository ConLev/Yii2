<?php

namespace frontend\controllers;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\WebSocket\WsConnection;

class Chat implements MessageComponentInterface
{
    /** @var  WsConnection[] */
    private $clients = [];

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        echo "server started\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients[$conn->resourceId] = $conn;
        echo "New connection : {$conn->resourceId} open\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onClose(ConnectionInterface $conn)
    {
        unset($this->clients[$conn->resourceId]);
        echo "Connection : {$conn->resourceId} close\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e->getMessage() . PHP_EOL;
        $conn->close();
        unset($this->clients[$conn->resourceId]);
    }

    /**
     * @param WsConnection $from
     * @param $msg
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        echo "{$from->resourceId}: {$msg}\n";
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }
}