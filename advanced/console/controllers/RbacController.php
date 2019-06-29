<?php

namespace console\controllers;

use Yii;
use yii\base\Exception;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * @throws Exception
     * @throws \Exception
     */
    public function actionIndex()
    {
        $am = Yii::$app->authManager;

        $admin = $am->createRole("admin");
        $moder = $am->createRole('moder');

        $am->add($admin);
        $am->add($moder);

        $permissionTaskCreate = $am->createPermission("TaskCreate");
        $permissionTaskUpdate = $am->createPermission("TaskUpdate");
        $permissionTaskDelete = $am->createPermission("TaskDelete");

        $am->add($permissionTaskCreate);
        $am->add($permissionTaskUpdate);
        $am->add($permissionTaskDelete);

        $am->addChild($admin, $permissionTaskCreate);
        $am->addChild($admin, $permissionTaskUpdate);
        $am->addChild($admin, $permissionTaskDelete);

        $am->addChild($moder, $permissionTaskCreate);
        $am->addChild($moder, $permissionTaskUpdate);

        $am->assign($admin, 1);
        $am->assign($moder, 8);
    }
}