<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'telegram_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'verification_token' => $this->string()->defaultValue(null)
        ], $tableOptions);

        $this->batchInsert('user', ['id', 'username', 'auth_key', 'password_hash', 'password_reset_token',
            'email', 'telegram_id', 'status', 'created_at', 'updated_at', 'verification_token'],
            [
                [1, 'admin', 'RBPVMDkJoSQfS1p0vMM_AFh8UBHRecbD',
                    '$2y$13$fk8u7fRq6aSWCVZgEwy1D.3T9aws4UqJ3M7dwDPmbKN3LF.CNo1te', NULL, 'admin@task-tracker.site',
                    NULL, 10, 1561111177, 1561111177, 'pf5rdIWQgqBlZ3rPzecL6ICnnjm04UeK_1561111177'],
                [2, 'user', 'UK12lz8vhZBYFQvjdx8hFHp4VCUW1MTl',
                    '$2y$13$PRgiWPpss58OTSRhAcNFTOWdluq0mIgjBiHIcU8RwlfRE6.7JJ2/O', NULL, 'user@task-tracker.site',
                    NULL, 10, 1561111452, 1561111452, 'QzZ_seKMj0mcNQAbx7bgBd0zLxIwHKu0_1561111452'],
                [3, 'Ivan', '4UhFhv0R7APHrj84GKH5B4m6TO-bE_wp',
                    '$2y$13$gAu.0jjSs9JhFN0osNhZjOXpJ3EK1zk1ROT2SKmd4Z02yfIQf4hdS', NULL, 'ivan@task-tracker.site',
                    NULL, 9, 1561111487, 1561111487, 'jLc4zarYnbDAecmDqC8hObxY9ZilOvdB_1561111487'],
                [4, 'Vadim', 'qE6NlnJRX-5cIoRlv9IgFjfZssSlu4_C',
                    '$2y$13$70q2H0zVLNg2eASaB3Qawu0JRFwCgZqT6RXy6s.R2SvRm3a4DG/nW', NULL, 'vadim@task-tracker.site',
                    NULL, 9, 1561111528, 1561111528, 'RRrh6GC-HvRVCYQ5sjWEewKBT9TYnwxp_1561111528'],
                [5, 'Sergey', 'EXmKygfOlMHK29K1teablvAtmW7cIf0X',
                    '$2y$13$r3D05Ub6pG9Gs58C8niDouS6RxKooaa4/rpIpirTPKSt/tzLbYyuO', NULL, 'sergey@task-tracker.site',
                    NULL, 9, 1561111565, 1561111565, 'qjijwGemaFD6Kt_RecDy_ajm52ddxw1F_1561111565'],
                [6, 'Nikolay', 'X3FTJTRtHtfWzcGjQiqY2c_o_nhF9_5i',
                    '$2y$13$c4AOXkmy39lu8qIuijaj6u/XpnaVOWtl9MNgKk1.KYnJiT/rkm3U2', NULL, 'nikolay@task-tracker.site',
                    NULL, 9, 1561111603, 1561111603, 'kkzHqgd9bFzfgmzh98or3ih4I0Ssnt9k_1561111603'],
                [7, 'Andrey', 'QVZQaF75DeMFr1mSOv8uT8LfOvrNq0p_',
                    '$2y$13$O8pSc5jczRrpVF3ECmRj1u7HWNgjr5S0mS.2MHbFdlsoHKnrjcmE.', NULL, 'andrey@task-tracker.site',
                    NULL, 9, 1561111646, 1561111646, 'aOB1kIldMQ7afNNqAmJfi8ajZUK_8Z3O_1561111646'],
                [8, 'Alex', 'Q_j_M3kJ5E2OTkftNg2zKvMCRM2zRPH-',
                    '$2y$13$F4MCKYIzfMnbbzs7ro65LumsshKgkzyvsFA3dg6RiNjxdop22EIdy', NULL, 'alex@task-tracker.site',
                    NULL, 10, 1561111687, 1561111687, 'H4czP0qCw9V8L07JvyBtxjyiNhp_m7iY_1561111687']
            ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
