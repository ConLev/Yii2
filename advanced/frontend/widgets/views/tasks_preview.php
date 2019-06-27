<?php

use common\models\tables\Tasks;
use yii\helpers\Url;

/** @var $model Tasks */
?>

<div class="task-container">
    <?php
    /** @var bool $linked */
    if ($linked): ?>
    <a class="task-preview-link" href="<?= Url::to(['tasks/one', 'id' => $model->id]) ?>">
        <? endif; ?>
        <div class="task-preview">
            <div class="task-preview-header"><?= 'Имя задачи: ', $model->name ?></div>
            <div class="task-preview-content"><?= 'Описание задачи: ', $model->description ?></div>
            <div class="task-preview-user"><?= 'Создал: ', $model->creator->username ?></div>
            <div class="task-preview-user"><?= 'Исполнитель: ', $model->responsible->username ?></div>
            <div class="task-preview-content"><?= 'Срок исполнения: ', $model->deadline ?></div>
            <div class="task-preview-content"><?= 'Статус задачи: ', $model->status->name ?></div>
        </div>
        <?php if ($linked): ?>
    </a>
<? endif; ?>
</div>