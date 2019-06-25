<?php

namespace app\widgets;

use common\models\tables\Tasks;
use Exception;
use yii\base\Widget;

class TasksPreview extends Widget
{
    public $model;
    public $linked = true;

    /**
     * @return string
     * @throws Exception
     */
    public function run()
    {
        if (is_a($this->model, Tasks::class)) {
            return $this->render('tasks_preview', [
                'model' => $this->model,
                'linked' => $this->linked
            ]);
        }
        throw new Exception("Модель должна быть класса Tasks!");
    }
}