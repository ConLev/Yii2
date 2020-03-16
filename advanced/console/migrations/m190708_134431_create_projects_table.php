<?php

use common\models\tables\Tasks;
use yii\db\Migration;

/**
 * Handles the creation of table 'projects'.
 */
class m190708_134431_create_projects_table extends Migration
{
    protected $projectsTable = 'projects';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment("Название проекта"),
            'description' => $this->string(),
            'creator_id' => $this->integer(),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ], $tableOptions);

        $this->batchInsert('projects', ['id', 'name', 'description', 'creator_id', 'created', 'updated'],
            [
                [1, 'Таск трекер', 'Разработать таск трекер используя фреймворк Yii2.', 765641979,
                    '2019-07-10 13:14:59', NULL]
            ]);

        $this->createIndex("project_creator_idx", 'projects', ['creator_id']);

        $this->createIndex("project_idx", 'tasks', ['project_id']);
        $this->addForeignKey('fk_project_id', 'tasks',
            'project_id', $this->projectsTable, 'id', 'CASCADE', 'NO ACTION');

        $this->createTable('telegram_subscribe', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer()->unique()->notNull(),
            'channel' => $this->string()->notNull()
        ], $tableOptions);

        $this->batchInsert('telegram_subscribe', ['id', 'chat_id', 'channel'],
            [
                [1, 765641979, 'projects_create']
            ]);

        $this->createIndex("channel_idx", "telegram_subscribe", ['channel']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_project_id', Tasks::tableName());
        $this->dropTable('projects');
        $this->dropTable('telegram_subscribe');
    }
}