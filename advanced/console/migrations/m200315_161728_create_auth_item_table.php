<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'auth_item'.
 */
class m200315_161728_create_auth_item_table extends Migration
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

        $this->createTable('auth_item', [
            'name' => $this->char(64)->notNull(),
            'type' => $this->integer(6)->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->char(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ], $tableOptions);

        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at',
            'updated_at'], [
            ['admin', 1, NULL, NULL, NULL, 1561714020, 1561714020],
            ['moder', 1, NULL, NULL, NULL, 1561714020, 1561714020],
            ['TaskCreate', 2, NULL, NULL, NULL, 1561714020, 1561714020],
            ['TaskDelete', 2, NULL, NULL, NULL, 1561714020, 1561714020],
            ['TaskUpdate', 2, NULL, NULL, NULL, 1561714020, 1561714020]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_item');
    }
}
