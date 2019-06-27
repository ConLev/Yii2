<?php

/** @var ActiveDataProvider $dataProvider */

use app\widgets\TasksPreview;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use frontend\assets\TasksAsset;

TasksAsset::register($this);
try {
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => function ($model) {
            return TasksPreview::widget(['model' => $model, 'linked' => true]);
        },
        'summary' => false,
        'options' => [
            'class' => 'preview-container'
        ]
    ]);
} catch (Exception $e) {
}