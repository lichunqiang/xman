<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require (__DIR__ . '/../../vendor/autoload.php');
require (__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require (__DIR__ . '/../../common/config/bootstrap.php');
require (__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require (__DIR__ . '/../../common/config/main.php'),
    require (__DIR__ . '/../../common/config/main-local.php'),
    require (__DIR__ . '/../config/main.php'),
    require (__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);
// Yii::$app->setViewPath('@app/views');
if (!\Yii::$app->session->isActive) {
    \Yii::$app->session->open();
}
\yii\base\Event::on(\yii\web\Response::className(), \yii\web\Response::EVENT_BEFORE_SEND, function ($event) {

    $response = $event->sender;
    $headers = $response->headers;
    $headers->add('Auther', 'light');
    // var_dump($response->headers);
});

// Yii::$classMap['yii\helpers\ArrayHelper'] = 'path/to/ArrayHelper.php';
$application->run();
