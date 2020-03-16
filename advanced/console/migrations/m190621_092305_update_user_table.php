<?php

use common\models\tables\Tasks;
use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m190621_092305_update_user_table extends Migration
{
    protected $tableName = 'user';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tasksTable = Tasks::tableName();

        $this->addForeignKey('fk_responsible_id', $tasksTable, 'responsible_id', $this->tableName,
            'id', 'cascade', 'no action');
        $this->addForeignKey('fk_creator_id', $tasksTable, 'creator_id', $this->tableName,
            'id', 'cascade', 'no action');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comments_users', 'task_comments');
        $this->dropForeignKey('fk_responsible_id', 'tasks');
        $this->dropForeignKey('fk_creator_id', 'tasks');
    }
}