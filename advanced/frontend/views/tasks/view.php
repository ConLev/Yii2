<?php

use common\models\tables\Tasks;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Tasks */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

if (!$hide) {
    $this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}

YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<div>{label} : {value}</div>',
        'attributes' => [
            'id',
            'name',
            'description',
            'creator_id',
            'responsible_id',
            'deadline',
            'status_id',
//            [
//                'label' => 'status',
//                'value' => $model->status->name,
//                'format' => 'html'
//            ],
        ],
        'options' => [
            'tag' => 'div',
        ]
    ]) ?>

</div>