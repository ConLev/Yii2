<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

$srcipt = <<<JS
    setInterval(function(){   
$("#btn-refresh").click();
}, 1000);
JS;

$this->registerJs($srcipt);

Pjax::begin(); ?>
    <div class="message-container">
        <?php
        echo Html::a("Refresh", ["telegram/receive"], ['id' => 'btn-refresh', 'class' => 'btn btn-success']);
        foreach ($messages as $message):?>
            <div>
                <strong><?= $message['username'] ?>: </strong>
                <?= $message['text'] ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php Pjax::end() ?>