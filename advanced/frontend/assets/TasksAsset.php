<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class TasksAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/tasks.css'
    ];

    public $js = [
        "js/task.js",
        'js/client.js'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}