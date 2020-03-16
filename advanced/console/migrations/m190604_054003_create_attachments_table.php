<?php

use common\models\tables\Tasks;
use common\models\tables\Users;
use yii\db\Migration;

/**
 * Handles the creation of table 'attachments'.
 */
class m190604_054003_create_attachments_table extends Migration
{
    protected $commentsTable = 'task_comments';
    protected $attachmentsTable = 'task_attachments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->commentsTable, [
            'id' => $this->primaryKey(),
            'content' => $this->string(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer(),
        ], $tableOptions);

        $this->batchInsert('task_comments', ['id', 'content', 'task_id', 'user_id'],
            [
                [1, 'Test', 1, 1],
                [2, 'test', 1, 2]
            ]);

        $taskTable = Tasks::tableName();
        $userTable = Users::tableName();

        $this->addForeignKey('fk_comments_tasks', $this->commentsTable,
            'task_id', $taskTable, 'id');
        $this->addForeignKey('fk_comments_users', $this->commentsTable,
            'user_id', $userTable, 'id');

        $this->createTable($this->attachmentsTable, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'path' => $this->string()
        ], $tableOptions);

        $this->batchInsert('task_attachments', ['id', 'task_id', 'path'],
            [
                [1, 1, 'aXziHf8ULJR6aRCA5fQux0tvdgZu19lW.jpg'],
                [2, 1, 'rU06-qNb4eSpVv0Y7QToxjJ1WfRQ5Se8.jpg']
            ]);

        $this->addForeignKey('fk_attachments_tasks', $this->attachmentsTable,
            'task_id', $taskTable, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->commentsTable);
        $this->dropTable($this->attachmentsTable);
    }
}