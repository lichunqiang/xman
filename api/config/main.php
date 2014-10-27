<?php
$params = array_merge(
    require (__DIR__ . '/../../common/config/params.php'),
    require (__DIR__ . '/../../common/config/params-local.php'),
    require (__DIR__ . '/params.php'),
    require (__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    // 'layout' => '@view/layouts/base.html',
    'layout' => false,
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => require (__DIR__ . '/_modules.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\DummyCache'
        ],
        'fcache' => [
            'class' => 'yii\caching\FileCache',
            'keyPrefix' => 'frontend'
        ],
        'mcache' => [
            'class' => 'yii\caching\MemCache'
        ],
        'user' => [
            'identityClass' => 'api\models\ChannelInfo',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login']
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
        'urlManager' => require (__DIR__ . '/_urlManager.php')
    ],
    'params' => $params,
];
