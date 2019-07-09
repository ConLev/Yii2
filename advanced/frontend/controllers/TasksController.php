<?php

namespace frontend\controllers;

use common\models\tables\Chat;
use frontend\models\forms\TaskAttachmentsAddForm;
use common\models\tables\TaskComments;
use common\models\tables\TaskStatuses;
use common\models\tables\Users;
use Yii;
use common\models\tables\Tasks;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class TasksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['one', 'index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['one'],
                        'allow' => true,
//                        'roles' => ['admin'],
//                        'roles' => ['TaskDelete'],
                        'roles' => ['@'],
                    ],
                ],
//                'denyCallback' => function () {}
            ],
        ];
    }

    public function actionIndex()
    {
//        return $this->render('index');

        /* $month = 6;
        $query = Tasks::find();
        if ($month) {
            $query->andWhere("MONTH(created) = ($month)");
        } */

        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find()
//            'query' => $query
        ]);

        /* Yii::$app->db->cache(function () use ($dataProvider) {
             return $dataProvider->prepare();
         }); */

        /* $statusesList =
             TaskStatuses::find()
                 ->select(['name'])
                 ->asArray()
                 ->indexBy('id')
                 ->column();
         var_dump($statusesList);
         exit; */

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionOne($id)
    {
        $chatHistory = Chat::find()
            ->where(['channel' => 'Task_' . $id])
            ->all();

        return $this->render("one", [
            'model' => Tasks::findOne($id),
            'statusesList' => TaskStatuses::getStatusesList(),
            'usersList' => Users::getUsersList(),
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'userId' => Yii::$app->user->id,
            'channel' => 'Task_' . $id,
            'chatHistory' => $chatHistory
        ]);
    }

    /* public function actionSave($id)
    {
        $task = Tasks::findOne($id);

        if ($task->load(Yii::$app->request->post()) && $task->save()) {
//            return $this->redirect(['index', 'id' => $task->id]);
            return $this->redirect(['index']);
        }
        return $this->render('one', ['task' => Tasks::findOne($id),]);
    } */

    public function actionSave($id)
    {

        if ($model = Tasks::findOne($id)) {
            $model->load(Yii::$app->request->post());
            $model->save();
//            Yii::$app->session->setFlash('success', "Отредактировано");
//        } else {
//            Yii::$app->session->setFlash('error', "Ошибка!");
            return $this->renderAjax('_tasks_save',
                [
                    'model' => $model,
                    'statusesList' => TaskStatuses::getStatusesList(),
                    'usersList' => Users::getUsersList(),
                ]);
        }
//        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddComment()
    {
        $model = new TaskComments();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            Yii::$app->session->setFlash('success', "Комментарий добавлен");
//        } else {
//            Yii::$app->session->setFlash('error', "Ошибка!");
            $id = $model->task_id;
            return $this->renderAjax('_comments',
                [
                    'model' => Tasks::findOne($id),
                    'taskCommentForm' => new TaskComments(),
                    'userId' => Yii::$app->user->id,
                ]);
        }
//        $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @throws Exception
     */
    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(Yii::$app->request->post());
        $model->attachment = UploadedFile::getInstance($model, 'attachment');
        if ($model->save()) {
//            Yii::$app->session->setFlash('success', "Файл добавлен");
//        } else {
//            Yii::$app->session->setFlash('error', "Ошибка!");
            $id = $model->taskId;
            return $this->renderAjax('_attachments',
                [
                    'model' => Tasks::findOne($id),
                    'taskAttachmentForm' => new TaskAttachmentsAddForm(),
                ]);
        }
//        $this->redirect(Yii::$app->request->referrer);
    }
}