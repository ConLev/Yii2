<?php

use common\models\tables\TaskStatuses;
use common\models\tables\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<?php
Pjax::begin([
    'enablePushState' => false,
    'id' => 'task_update'
]);
?>
    <div class="task-edit">
        <div class="task-main">
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['tasks/save', 'id' => $model->id]),
                'options' => ['data-pjax' => true]
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
            <!--        <button class="push-me-btn">Push</button>-->
        </div>
    </div>
<?php Pjax::end() ?>