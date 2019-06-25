<?php

namespace common\models\tables;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name Название задачи
 * @property string $description
 * @property int $creator_id
 * @property int $responsible_id
 * @property string $deadline
 * @property int $status_id
 * @property string $created
 * @property string $updated
 *
 * @property int $status
 * @property $creator
 * @property $responsible
 */
class Tasks extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['deadline', 'created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'task_name'),
            'description' => Yii::t('app', 'task_description'),
            'creator_id' => 'Creator ID',
            'responsible_id' => Yii::t('app', 'task_responsible'),
            'deadline' => Yii::t('app', 'task_deadline'),
            'status_id' => Yii::t('app', 'task_status'),
            'created' => 'Created',
            'updated' => 'Updated'
        ];
    }

    public static function findDeadline()
    {
        static::find()
            ->where("DATEDIFF(NOW(), tasks.deadline) <= 1")
            ->with('responsible')
            ->all();
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
    }

    public function getCreator()
    {
        return $this->hasOne(Users::class, ['id' => 'creator_id']);
    }

    public function getResponsible()
    {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

    public function getTaskComments()
    {
        return $this->hasMany(TaskComments::class, ['task_id' => 'id']);
    }

    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::class, ['task_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}