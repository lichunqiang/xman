<?php
namespace backend\controllers;

use backend\models\ChannelInfo;
use Yii;
use yii\web\Controller as BaseController;

class TestController extends BaseController
{
    public $layout = '@backend/views/layouts/main.php';

    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback']
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function actionIndex()
    {
        // $channel = ChannelInfo::findOne(['ch_id' => 10000]);
        // var_dump($channel->ch_account);

        // $channel2 = ChannelInfo::findIdentity(10000);
        // $user = Yii::$app->getUser();
        // $user->login($channel2);
        // // var_dump($channel2);
        // var_dump($channel2->primaryKey());
        // // $res = $channel->equals($channel2);
        // // var_dump($res);
        // var_dump($user->getIdentity());
        $user_form = new \backend\models\UserForm;
        $user_form->scenario = 'login';
        $user_form->attributes = Yii::$app->request->post('UserForm');
        var_dump($user_form->toArray());
        return $this->render('index.php', ['model' => $user_form]);
    }

    public function actionLogin()
    {
        $channel = ChannelInfo::findIdentity(10000);
        $user = Yii::$app->getUser();
        $user->login($channel);
        return $this->render('index.php');
    }

    public function actionLogout()
    {
        $user = Yii::$app->getUser();
        $user->logout();
    }

    public function actionTest()
    {
        // $user = Yii::$app->getUser();
        // var_dump($user->getIdentity());

        return $this->render('index.php');
    }

    public function successCallback($client)
    {
        var_dump($client->accessToken->params);
        var_dump($client->getUserAttributes());
        var_dump($client->getUserInfo());
        exit;
    }

    public function actionCancelAuth()
    {
        echo 'your canceled';
    }

    public function actionShowauth()
    {
        return $this->render('auth_list.php');
    }

    public function actionShowToken()
    {
        $client = new \backend\components\authclient\Weibo;

        $token = $client->getAccessToken();
        var_dump($token);
    }

    public function actionThrow()
    {
        throw new \yii\web\NotFoundHttpException('this is message');
    }
}
