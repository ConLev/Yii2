<?php

use common\models\tables\Tasks;
use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m190621_092305_create_users_table extends Migration
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
        $this->dropTable('users');
    }
}