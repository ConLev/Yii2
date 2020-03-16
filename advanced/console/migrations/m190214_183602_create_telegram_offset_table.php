<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'telegram_offset'.
 */
class m190214_183602_create_telegram_offset_table extends Migration
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

        $this->createTable('telegram_offset', [
            'id' => $this->integer(),
            'timestamp_offset' => $this->timestamp()
        ], $tableOptions);

        $this->batchInsert('telegram_offset', ['id', 'timestamp_offset'],
            [
                [196950289, '2019-07-10 10:31:14']
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('telegram_offset');
    }
}
