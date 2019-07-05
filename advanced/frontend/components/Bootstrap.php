<?php

namespace frontend\components;

use common\models\tables\Tasks;
use common\models\tables\Users;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class Bootstrap extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->setLang();
        $this->attachEventsHandler();
    }

    private function attachEventsHandler()
    {
        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function (Event $event) {
            /** @var Tasks $task */
            $task = $event->sender;
            /** @var Users $resposible */
            $responsible = $task->responsible;
            $creator = $task->creator;
            Yii::$app->mailer->compose()
                ->setTo($responsible->email)
                ->setFrom($creator->email)
                ->setSubject('New Task')
                ->setTextBody("Dear {$responsible->username}, new task {$task->id} created")
                ->send();
        });
    }

    private function setLang()
    {
        if ($lang = Yii::$app->session->get('lang')) [
            Yii::$app->language = $lang
        ];
    }
}