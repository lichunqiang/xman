<?php
$params = array_merge(
    require (__DIR__ . '/../../common/config/params.php'),
    require (__DIR__ . '/../../common/config/params-local.php'),
    require (__DIR__ . '/params.php'),
    require (__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    // 'layout' => '@view/layouts/base.html',
    'layout' => false,
    'controllerNamespace' => 'backend\controllers',
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
            'identityClass' => 'backend\models\ChannelInfo',
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
        'view' => [
            'class' => 'yii\web\view',
            'defaultExtension' => 'html',
            'renderers' => [
                'html' => [
                    'class' => 'yii\smarty\ViewRenderer',
                    'cachePath' => '@runtime/smarty/cache',
                    'options' => [
                        'left_delimiter' => '<{',
                        'right_delimiter' => '}>',
                        'debugging' => YII_DEBUG,
                        'caching' => !YII_DEBUG,
                        'cache_lifetime' => 1 * 24 * 3600
                    ]
                ],
            ],
            //@see https://github.com/yiisoft/yii2/blob/master/docs/guide/output-theming.md
            // 'theme' => [
            //     'pathMap' => [
            //         '@app/views' => '@app/themes/basic'
            //     ]
            // ],
        ],
        'errorHandler' => [
            'errorAction' => 'test/error',
        ],
        'urlManager' => require (__DIR__ . '/_urlManager.php')
    ],
    'params' => $params,
    'controllerMap' => [
        'fixtures' => [
            'class' => 'yii\faker\FixtureController'
        ]
    ]
];
