<?php

use frontend\components\Bootstrap;
use yii\i18n\PhpMessageSource;
use yii\rest\UrlRule;
use yii\web\JsonParser;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'bootstrap'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'v1' => [
            'class' => 'frontend\modules\v1\Module',
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => '@app/messages'
                ]
            ]
        ],
        'bootstrap' => [
            'class' => Bootstrap::class
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/test',
                'baseUrl' => '@app/web/themes/test',
                'pathMap' => [
                    '@app/views' => '@app/themes/test'
                ]
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => JsonParser::class
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => '.tasks.site'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'GET message/<id>' => 'message/view',
//                'PATH message/<id>' => 'message/update'
                [
//                    'class' => UrlRule::class,
//                    'controller' => ['v1/message']
                    'class' => UrlRule::class,
                    'controller' => ['v1/task']
                ]
            ],
        ],
    ],
    'params' => $params,
];