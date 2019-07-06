<?php use yii\helpers\Html;
use yii\widgets\Pjax; ?>

<?php Pjax::begin(['enablePushState' => true]) ?>
<?= Html::a("Часы", ['pjax/hours'], ['class' => 'btn btn-success']); ?>
<?= Html::a("Минуты", ['pjax/minutes'], ['class' => 'btn btn-warning']); ?>
    <h2>Текущее время: <?= $time ?></h2>
<?php Pjax::end() ?>