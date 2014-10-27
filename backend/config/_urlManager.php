<?php

return [
    'enablePrettyUrl' => true,
    // 'enableStrictParsing' => true,
    'showScriptName' => false,
    // 'suffix' => '.html',
    'rules' => [
        '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
        '<controller:(site|post|comment)>/<id:\d+>' => '<controller>/read',
        '<controller:(site|post|comment)s>' => '<controller>/list',
        '<controller:user>/<action:add>' => 'site/add-user',
        'http://<user:\w+>.yii-start.com/<lang:\w+>/profile' => 'site/profile',
        // 'admin/<controller:(test)>/<id:\d+>' => 'admin/<controller>/read'
        // ['class' => 'yii\rest\UrlRule', 'controller' => 'user']
    ]
];
