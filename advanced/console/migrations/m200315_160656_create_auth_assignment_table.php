<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'auth_assignment'.
 */
class m200315_160656_create_auth_assignment_table extends Migration
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

        $this->createTable('auth_assignment', [
            'item_name' => $this->char(64)->notNull(),
            'user_id' => $this->char(64)->notNull(),
            'created_at' => $this->integer(11)
        ], $tableOptions);

        $this->batchInsert('auth_assignment', ['item_name', 'user_id', 'created_at'],
            [
                ['admin', '1', 1561714020],
                ['moder', '8', 1561714020]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_assignment');
    }
}
