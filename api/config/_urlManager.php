<?php

return [
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    // 'suffix' => '.html',
    'rules' => [
        ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/user', 'v1/post']],
        ['class' => 'yii\rest\UrlRule', 'controller' => ['v2/user', 'v2/post']]
    ]
];
