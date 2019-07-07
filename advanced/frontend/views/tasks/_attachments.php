<?php

use frontend\models\forms\TaskAttachmentsAddForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<?php
Pjax::begin([
    'enablePushState' => false,
    'id' => 'task_attachments'
]);
?>
    <h3><?= Yii::t('app', 'task_attachments') ?></h3>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['tasks/add-attachment']),
    'options' => [
        'class' => "form-inline",
        'data-pjax' => true
    ]
]); ?>
<?= /** @var TaskAttachmentsAddForm $taskAttachmentForm */
$form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false); ?>
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
<?php Pjax::end() ?>