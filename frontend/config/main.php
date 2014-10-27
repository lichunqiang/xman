<?php
$params = array_merge(
    require (__DIR__ . '/../../common/config/params.php'),
    require (__DIR__ . '/../../common/config/params-local.php'),
    require (__DIR__ . '/params.php'),
    require (__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'admin'],
    // 'language' => 'en-US',
    'language' => 'zh-CN',
    // 'layout' => '@view/layouts/base.html',
    'layout' => false,
    'controllerNamespace' => 'frontend\controllers',
    'modules' => require (__DIR__ . '/modules.php'),
    'defaultRoute' => 'site',
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
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['trace', 'warning']
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['profile'],
                    'logFile' => '@runtime/logs/profile.log'
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@runtime/logs/error.log'
                ]
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => YII_DEBUG ? false : '@runtime/twig/cache',
                    'options' => [],
                    // 'globals' => ['html' => 'yii\helpers\Html'],
                    'uses' => ['yii\bootstrap']
                ]
            ],
            //@see https://github.com/yiisoft/yii2/blob/master/docs/guide/output-theming.md
            // 'theme' => [
            //     'pathMap' => [
            //         '@app/views' => '@app/themes/basic'
            //     ]
            // ],
        ],
        // 'config' => [
        //     'class' => 'app\components\Config',
        //     'loadModel' => 'app\models\Config'
        // ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'suffix' => '.html',
            'rules' => [
                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                '<controller:(site|post|comment)>/<id:\d+>' => '<controller>/read',
                '<controller:(site|post|comment)s>' => '<controller>/list',
                '<controller:user>/<action:add>' => 'site/add-user',
                'http://<user:\w+>.yii-start.com/<lang:\w+>/profile' => 'site/profile',
                // 'admin/<controller:(test)>/<id:\d+>' => 'admin/<controller>/read'
            ]
        ]
    ],
    'params' => $params
];
