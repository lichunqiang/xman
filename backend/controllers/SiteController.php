<?php
namespace backend\controllers;

use backend\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = false;//'@view/layouts/main.php';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'page'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'page' => [
                'class' => 'yii\web\ViewAction',
                'layout' => false,
                'viewPrefix' => 'pages',
                'viewParam' => 'section'
            ],
        ];
    }

    public function actionIndex()
    {
        // $app = Yii::$app;
        // $locator = new yii\di\ServiceLocator;
        // $cache = $locator->get('log');
        // var_dump($cache);
        $session = Yii::$app->session;
        var_dump($session);
        echo 'running action';
        // $channel = \backend\models\ChannelInfo::find()->indexBy('ch_id')->all();
        // var_dump($channel);
        // $count = \backend\models\ChannelInfo::find()->count();
        // var_dump($count);
        // $user = Yii::$app->getUser();
        //current channel id
        // $ch_id = $user->getId();
        // var_dump($user);

        // $channel_info = $user->getIdentity();
        // return $this->render('index');
    }

    public function actionLogin()
    {

        Yii::$app->getView()->title = Yii::t('app', 'login_title');

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            // var_dump($model->errors);
            return $this->render('login.html', [
                'model' => $model,
                'msg' => implode($model->getFirstErrors())
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function successCallback($client)
    {
        var_dump($client);
    }
}
