<?php

return [
    // 'id' => 'front-admin',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'test',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache'
        ],
    ],
    'params' => [
        'key' => 'test_key_for_me'
    ]
];
