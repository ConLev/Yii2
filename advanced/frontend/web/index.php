<?php

// начинаем сбор информации,
// дополнительно будем собирать информацию об использовании оперативной памяти и процессоре
//xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();

// останавливаем сбор информации о вызовах
//$xhprof_data = xhprof_disable();
//include_once 'xhprof/xhprof_lib/utils/xhprof_lib.php';
//include_once 'xhprof/xhprof_lib/utils/xhprof_runs.php';
//$xhprof_runs = new XHProfRuns_Default();
//// save the run under a namespace "xhprof_foo"
//$run_id = $xhprof_runs->save_run($xhprof_data, 'xhprof_foo');
//// внизу страницы отобразим ссылку на просмотр
//echo "<a href='/xhprof_html/index.php?run={$run_id}&source=xhprof_foo' target='_blank'>profile</a>";