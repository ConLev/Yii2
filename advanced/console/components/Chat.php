<?php

namespace console\components;

use common\models\User;
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
        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode('=', $queryString)[1];

        $this->clients[$channel][$conn->resourceId] = $conn;
        echo "New connection: {$conn->resourceId}";
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
     * @param string $msg {user_id : 1, message : '', channel: 'Task_1'}
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        echo "{$from->resourceId}: {$msg}";
        $data = json_decode($msg, true);

        $values = [
            'channel' => $data['channel'],
            'message' => $data['message'],
            'user_id' => $data['user_id'],
            'created_at' => date("Y-m-d H:i:s")
        ];

        $chat = new \common\models\tables\Chat();
        $chat->attributes = $values;
        $chat->save();

        $channel = $data['channel'];

        $user = User::find()
            ->where(['id' => $data['user_id']])
            ->one();

        foreach ($this->clients[$channel] as $client) {
            $client->send(json_encode(['username' => $user['username'] . ": ", 'message' => $data['message']]));
        }
    }
}