<?php

namespace common\models\tables;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task_attachments".
 * @property int $id
 * @property int $task_id
 * @property string $path
 *
 * @property Tasks $task
 */
class TaskAttachments extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_attachments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'path' => 'Path',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }
}