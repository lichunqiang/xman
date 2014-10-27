<?php
return [
    'forum' => [
        'class' => 'frontend\modules\forum\Module',
    ],
    'admin' => [
        'class' => 'frontend\modules\admin\Module'
    ],
    'user' => [
        'class' => 'dektrium\user\Module',
        'enableRegistration' => true,
        'controllerMap' => [
        ],
        'layout' => '@app/views/layouts/main.php'
    ]
];
