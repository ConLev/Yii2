<?php

use common\models\tables\Tasks;
use common\models\tables\Users;
use yii\db\Migration;

/**
 * Handles the creation of table `projects`.
 */
class m190708_134431_create_projects_table extends Migration
{
    protected $projectsTable = 'projects';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment("Название проекта"),
            'description' => $this->string(),
            'creator_id' => $this->integer(),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ]);
        $this->createIndex("project_creator_idx", 'projects', ['creator_id']);

        $taskTable = Tasks::tableName();
        $this->addColumn($taskTable, 'project_id', $this->integer()->notNull()->after('id'));

        $this->createIndex("project_idx", 'tasks', ['project_id']);
        $this->addForeignKey('fk_project_id', $taskTable,
            'project_id', $this->projectsTable, 'id', 'CASCADE', 'NO ACTION');

        $usersTable = Users::tableName();
        $this->addColumn($usersTable, 'telegram_id', $this->integer()->after('email'));
        $this->addColumn($usersTable, 'subscription', $this->boolean()->after('telegram_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('projects');
    }
}