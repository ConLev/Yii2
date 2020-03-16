<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'auth_item_child'.
 */
class m200315_162902_create_auth_item_child_table extends Migration
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

        $this->createTable('auth_item_child', [
            'parent' => $this->char(64)->notNull(),
            'child' => $this->char(64)->notNull()
        ], $tableOptions);

        $this->batchInsert('auth_item_child', ['parent', 'child'],
            [
                ['admin', 'TaskCreate'],
                ['admin', 'TaskDelete'],
                ['admin', 'TaskUpdate'],
                ['moder', 'TaskCreate'],
                ['moder', 'TaskUpdate']
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_item_child');
    }
}
