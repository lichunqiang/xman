<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        // 'cache' => [
        //     'class' => 'yii\caching\FileCache',
        // ],
        // 'view' => [
        //     'class' => 'yii\web\view',
        //     'defaultExtension' => 'html',
        //     'renderers' => [
        //         'tpl' => [
        //             'class' => 'yii\smarty\ViewRenderer',
        //             'cachePath' => '@runtime/smarty/cache',
        //             'options' => ['left_delimiter' => '<{', 'right_delimiter' => '}>']
        //         ],
        //         'html' => [
        //             'class' => 'yii\twig\ViewRenderer',
        //             'cachePath' => YII_DEBUG ? false : '@runtime/twig/cache',
        //             'options' => [],
        //             // 'globals' => ['html' => 'yii\helpers\Html'],
        //             'uses' => ['yii\bootstrap']
        //         ]
        //     ]
        // ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', //app下的messages文件夹
                    // 'sourceLanguage' => 'en-UK'//默认en-US，如果当前语言和此项不一致则去找翻译文件
                ],
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages'
                ]
            ]
        ],
        // 'urlManager' => array(
        //     'showScriptName' => false,
        //     'enablePrettyUrl' => true,
        //     'rules' => require(__DIR__ . '/rewrite.php')
        // ),
    ],
];
