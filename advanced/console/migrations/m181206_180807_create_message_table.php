<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'message'.
 */
class m181206_180807_create_message_table extends Migration
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

        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'content' => $this->text(),
            'user_id' => $this->integer()
        ], $tableOptions);

        $this->batchInsert('message', ['id', 'title', 'content', 'user_id'],
            [
                [1, 'New message 1', 'hfhhhhhh hhhshhhdh', 1],
                [3, 'Message 3', '333333333333333333333', 1],
                [4, 'Message 4', '4444444444444444444', 1],
                [5, 'Message 5', '55555555555555555555555', 1],
                [6, 'Message 6', '6666666666666666666666666666', 1],
                [7, 'Message 7', '77777777777777777777', 1],
                [8, 'Message 8', '88888888888888888888888', 1]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('message');
    }
}