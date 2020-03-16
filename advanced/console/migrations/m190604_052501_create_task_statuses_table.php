<?php

use common\models\tables\Tasks;
use yii\db\Migration;

/**
 * Handles the creation of table `task_statuses`.
 */
class m190604_052501_create_task_statuses_table extends Migration
{
    protected $tableName = 'task_statuses';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)
        ], $tableOptions);

        $this->batchInsert($this->tableName, ['name'], [
            ['Новая'],
            ['В работе'],
            ['Выполнена'],
            ['Тестирование'],
            ['Доработка'],
            ['Закрыта'],
        ]);

        $taskTable = Tasks::tableName();

        //$this->addColumn($taskTable,'status', $this->integer());

        $this->addForeignKey('fk_task_statuses', $taskTable, 'status_id', $this->tableName, 'id');
        $this->update($taskTable, ['status_id' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $taskTable = Tasks::tableName();

        $this->dropForeignKey('fk_task_statuses', $taskTable);

        $this->dropTable($this->tableName);
    }
}