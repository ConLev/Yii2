<?php

use frontend\assets\TasksAsset;
use frontend\controllers\TasksController;
use frontend\models\forms\TaskAttachmentsAddForm;
use common\models\tables\TaskComments;
use common\models\tables\TaskStatuses;
use common\models\tables\Users;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;
use yii\widgets\Pjax;

/** @var TaskComments $taskCommentForm */
/** @var TaskAttachmentsAddForm $taskAttachmentForm */
TasksAsset::register($this);

?>
    <div class="task-edit">
        <div class="task-main">
            <?php Pjax::begin([
                'id' => 'task_edit',
                'timeout' => false,
                'enablePushState' => false,
                'formSelector' => '#task_edit'
            ]) ?>
            <?php $form = ActiveForm::begin([
                'id' => 'task_edit',
                'options' => ['data-pjax' => true],
                'action' => Url::to(['tasks/save', 'id' => $model->id])
            ]); ?>
            <?= $form->field($model, 'name')->textInput(); ?>
            <div class="row">
                <div class="col-lg-4">
                    <?php
                    // получаем все статусы
                    $tasks = TaskStatuses::find()->all();
                    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                    $items_tasks = ArrayHelper::map($tasks, 'id', 'name');
                    ?>
                    <!--                --><? //= $form->field($model, 'status_id')->dropDownList($items_tasks); ?>
                    <?= /** @var $statusesList */
                    $form->field($model, 'status_id')->dropDownList($statusesList); ?>
                </div>
                <div class="col-lg-4">
                    <?php
                    // получаем всех пользователей
                    $users = Users::find()->all();
                    // формируем массив, с ключем равным полю 'id' и значением равным полю 'username'
                    $items_users = ArrayHelper::map($users, 'id', 'username');
                    ?>
                    <!--                --><? //= $form->field($model, 'responsible_id')->dropDownList($items_users); ?>
                    <?= /** @var $usersList */
                    $form->field($model, 'responsible_id')->dropDownList($usersList); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'deadline')
                        ->widget(DatePicker::class, [
                            'language' => 'ru',
                            'dateFormat' => 'yyyy-MM-dd'
                        ])
                    //                    ->textInput(['type' => 'date'])
                    ?>
                </div>
            </div>

            <div>
                <?= $form->field($model, 'description')
                    ->textarea() ?>
            </div>
            <?php if (Yii::$app->user->can('TaskUpdate')): ?>
                <?= Html::submitButton("Сохранить", ['class' => 'btn btn-success']); ?>
            <?php endif ?>
            <? ActiveForm::end() ?>
            <?php Pjax::end() ?>
            <!--        <button class="push-me-btn">Push</button>-->
        </div>
    </div>
<?php //if (Yii::$app->user->can('TaskDelete')): ?>
    <div class="attachments">
        <h3><?= Yii::t('app', 'task_attachments') ?></h3>
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['tasks/add-attachment']),
            'options' => ['class' => "form-inline"]
        ]); ?>
        <?= $form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false); ?>
        <?= $form->field($taskAttachmentForm, 'attachment')->fileInput()
            ->label(Yii::t('app', 'task_attachments')); ?>
        <?= Html::submitButton("Загрузить", ['class' => 'btn btn-default']); ?>
        <? ActiveForm::end() ?>
        <hr>
        <div class="attachments-history">
            <? foreach ($model->taskAttachments as $file): ?>
                <a href="/img/tasks/<?= $file->path ?>">
                    <img src="/img/tasks/small/<?= $file->path ?>" alt="">
                </a>
            <?php endforeach; ?>
        </div>
        <h3><?= Yii::t('app', 'task_comments') ?></h3>
        <?php $form = ActiveForm::begin(['action' => Url::to(['tasks/add-comment'])]); ?>
        <?= /** @var TasksController $userId */
        $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>
        <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false); ?>
        <?= $form->field($taskCommentForm, 'content')->textInput(); ?>
        <?= Html::submitButton("Добавить", ['class' => 'btn btn-default']); ?>
        <? ActiveForm::end() ?>
        <hr>
        <div class="comment-history">
            <? foreach ($model->taskComments as $comment): ?>
                <p><strong><?= $comment->user->username ?></strong>: <?= $comment->content ?></p>
            <?php endforeach; ?>
        </div>
        <hr>
        <div class="chat-history">
            <? foreach ($chatHistory as $data): ?>
                <p><strong><?= $data->user->username ?></strong>: <?= $data->message ?></p>
            <?php endforeach; ?>
        </div>
        <div id="ws_chat"></div>
        <div class="task-chat">
            <form action="#" name="chat_form" id="chat_form">
                <label>
                    <input type="hidden" name="channel" value="<?= $channel ?>"/>
                    <input type="hidden" name="user_id" value="<?= $userId ?>"/>
                    введите сообщение
                    <input type="text" name="message"/>
                    <input type="submit"/>
                </label>
            </form>
        </div>
    </div>
    <script>
        var channel = '<?=$channel?>';
    </script>
<?php //endif;