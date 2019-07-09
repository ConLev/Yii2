<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'bot' => [
            'class' => SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => '863269621:AAE1q1gMTEcChm7JpHvFQGeA6EBSMP97qHg',
        ],
    ],
];