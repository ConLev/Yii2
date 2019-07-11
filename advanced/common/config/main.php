<?php

use common\components\BootstrapComponent;

return [
    'bootstrap' => ['bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'bootstrap' => [
            'class' => BootstrapComponent::class
        ],
        'bot' => [
            'class' => SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => '863269621:AAE1q1gMTEcChm7JpHvFQGeA6EBSMP97qHg',
        ],
    ],
];