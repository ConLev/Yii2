<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'tasks'.
 */
class m190604_050756_create_tasks_table extends Migration
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

        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'name' => $this->string(50)->notNull()->comment("Название задачи"),
            'description' => $this->string(),
            'creator_id' => $this->integer(),
            'responsible_id' => $this->integer(),
            'deadline' => $this->date(),
            'status_id' => $this->integer(),
//            'created' => $this->timestamp(),
            'created' => $this->dateTime(),
//            'updated' => $this->timestamp(),
            'updated' => $this->dateTime(),
        ], $tableOptions);

        $this->batchInsert('tasks', ['id', 'project_id', 'name', 'description', 'creator_id', 'responsible_id',
            'deadline', 'status_id', 'created', 'updated'],
            [
                [1, 1, 'Task 1', 'Install Framework', 1, 2, '2019-07-11', 2, NULL, NULL],
                [2, 1, 'Task 2', 'Create Migration', 1, 3, '2019-07-11', 3, NULL, NULL],
                [3, 1, 'Task 3', 'Magic <a href=\'#\'> link </a>', 1, 4, '2019-07-18', 2, NULL, NULL],
                [4, 1, 'Task 4', 'Magic', 1, 5, '2019-07-18', 2, NULL, NULL],
                [5, 1, 'Task 5', 'Magic', 1, 6, '2019-07-18', 2, NULL, NULL],
                [6, 1, 'Task 6', 'Magic', 1, 7, '2019-07-18', 2, NULL, NULL],
                [7, 1, 'Task 7', 'Magic', 1, 8, '2019-07-18', 2, NULL, NULL]
            ]);

        $this->createIndex("tasks_creator_idx", 'tasks', ['creator_id']);
        $this->createIndex("tasks_responsible_idx", 'tasks', ['responsible_id']);
        $this->createIndex("tasks_status_idx", 'tasks', ['status_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }
}