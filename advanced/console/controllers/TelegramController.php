<?php

namespace console\controllers;

use common\models\tables\Projects;
use common\models\tables\TelegramOffset;
use common\models\tables\Users;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use Yii;
use yii\console\Controller;

class TelegramController extends Controller
{
    /** @var  Component */
    private $bot;
    private $offset = 0;

    public function init()
    {
        parent::init();
        $this->bot = Yii::$app->bot;
    }

    public function actionIndex()
    {
        $updates = $this->bot->getUpdates($this->getOffset() + 1);
        $updCount = count($updates);
        if ($updCount > 0) {
            echo "Новых сообщений " . $updCount . PHP_EOL;
            foreach ($updates as $update) {
                $this->updateOffset($update);
                $this->processCommand($update->getMessage());
            }
        } else {
            echo "Новых сообщений нет" . PHP_EOL;
        }
    }

    private function getOffset()
    {
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if ($max > 0) {
            $this->offset = $max;
        }
        return $this->offset;
    }

    private function updateOffset(Update $update)
    {
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date("Y-m-d H:i:s")
        ]);
        $model->save();
    }

    private function createProject(Message $message)
    {
        $params = explode(":", $message->getText());
        $creator = $message->getFrom()->getId();
        if (!empty($params[1])) {
            $model = new Projects([
                'name' => $params[1],
                'description' => $params[2],
                'creator_id' => $creator,
                'created' => date("Y-m-d H:i:s")
            ]);
            $model->save();
        } else {
            $response = "Вы не ввели обязательный параметр - имя проекта";
            $this->bot->sendMessage($message->getFrom()->getId(), $response);
            exit;
        }
    }

    private function userSubscription(Message $message)
    {
        $id = $message->getFrom()->getId();
        $user = Users::find()
            ->where(['telegram_id' => $id])
            ->one();
        $user->subscription = 1;
        $user->save();
    }

    private function sendingMessages($params)
    {
        $response = "Создан новый проект: $params[1]\n";
        $users = Users::find()
            ->where(['subscription' => 1])
            ->all();
        foreach ($users as $user) {
            $this->bot->sendMessage($user->telegram_id, $response);
        }
    }

    private function processCommand(Message $message)
    {
        $params = explode(":", $message->getText());
        $command = $params[0];
        $response = 'Unknown command';
        switch ($command) {
            case "/help":
                $response = "Доступные команды: \n";
                $response .= "/help - список комманд\n";
                $response .= "/project_create ##:name(required):description## - создание нового проекта\n";
                $response .= "/task_create ##task_name## ##responcible## ##project## - создание нового таска\n";
                $response .= "/sp_create - подписка на оповещение о создании новых проектов\n";
                break;
            case "/project_create":
                $this->createProject($message);
                $response = "Вы создали новый проект: $params[1]\n";
                $this->sendingMessages($params);
                break;
            case "/sp_create":
                $this->userSubscription($message);
                $response = "Вы подписаны на оповещение о создании новых проектов\n";
                break;
        }
        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }
}