<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'chat'.
 */
class m181129_173447_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'channel' => $this->string(),
            'message' => $this->string(),
            'user_id' => $this->integer(),
            'created_at' => $this->dateTime()
        ], $tableOptions);

        $this->batchInsert('chat', ['id', 'channel', 'message', 'user_id', 'created_at'],
            [
                [1, 'Task_1', 'Test', 2, '2019-07-04 15:58:33'],
                [2, 'Task_1', 'Test', 1, '2019-07-04 15:59:01']
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chat');
    }
}