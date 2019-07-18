<?php

namespace frontend\modules\v1\controllers;

use common\models\tables\Tasks;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Tasks::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentificator'] = [
            'class' => HttpBearerAuth::class
            /* 'class' => HttpBasicAuth::class,
             'auth' => function ($username, $password) {
                 $user = User::findByUsername($username);
                 if ($user !== null && $user->validatePassword($password)) {
                     return $user;
                 }
                 return null;
             } */
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    //front.tasks.site/v1/tasks?filter={"responsible_id":2}

    public function actionIndex($filter = null)
    {
        $filter = json_decode($filter, true);

        if ($filter) {
            $qwery = Tasks::find()
                ->andWhere($filter);
            return new ActiveDataProvider([
                'query' => $qwery,
            ]);
        } else {
            return new ActiveDataProvider([
                'query' => Tasks::find()
            ]);
        }
    }
}