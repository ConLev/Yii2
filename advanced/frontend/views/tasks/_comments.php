<?php

use common\models\tables\TaskComments;
use frontend\controllers\TasksController;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<?php
Pjax::begin([
    'enablePushState' => false,
    'id' => 'task_comments'
]);
?>
    <h3><?= Yii::t('app', 'task_comments') ?></h3>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['tasks/add-comment']),
    'options' => ['data-pjax' => true]
]); ?>
<?= /** @var TasksController $userId */
/** @var TaskComments $taskCommentForm */
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
<?php Pjax::end() ?>