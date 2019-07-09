<?php

use common\models\User;
use frontend\assets\TasksAsset;
use frontend\models\forms\TaskAttachmentsAddForm;
use common\models\tables\TaskComments;
use common\models\tables\TaskStatuses;
use common\models\tables\Users;

/** @var TaskComments $taskCommentForm */
/** @var TaskAttachmentsAddForm $taskAttachmentForm */
TasksAsset::register($this);

?>

<?= $this->render('_task_update',
    [
        'model' => $model,
        'statusesList' => TaskStatuses::getStatusesList(),
        'usersList' => Users::getUsersList(),
    ]);
?>
<?php //if (Yii::$app->user->can('TaskDelete')): ?>
    <div class="attachments">
        <?= $this->render('_attachments',
            [
                'model' => $model,
                'taskAttachmentForm' => $taskAttachmentForm
            ]);
        ?>
        <hr>
        <?= /** @var User $userId */
        $this->render('_comments', [
            'model' => $model,
            'taskCommentForm' => $taskCommentForm,
            'userId' => $userId
        ]);
        ?>
        <hr>
        <div class="chat-history">
            <? /** @var $chatHistory */
            foreach ($chatHistory as $data): ?>
                <p><strong><?= $data->user->username ?></strong>: <?= $data->message ?></p>
            <?php endforeach; ?>
        </div>
        <div id="ws_chat"></div>
        <div class="task-chat">
            <form action="#" name="chat_form" id="chat_form">
                <label>
                    <input type="hidden" name="channel" value="<?= /** @var $channel */
                    $channel ?>"/>
                    <input type="hidden" name="user_id" value="<?= $userId ?>"/>
                    введите сообщение
                    <input type="text" name="message"/>
                    <input type="submit"/>
                </label>
            </form>
        </div>
    </div>
    <script>
        let channel = '<?=$channel?>';
    </script>
<?php //endif;