<?php
namespace frontend\modules\admin\controllers;

// use frontend\modules\admin\models\LoginForm;
use yii;
use yii\base\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class TestController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get']
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function actionIndex()
    {

        var_dump($this->module->cache);
        // echo 'this is index';
        var_dump(\Yii::$app->cache);
        //throw new \yii\web\ForbiddenHttpException('this is forbidden');
    }

    public function actionRead()
    {
        // var_dump(Yii::$app->);
        $request = Yii::$app->request;
        var_dump($request->get());
    }

    public function actionTemplate()
    {
        return $this->render('index');
    }

    public function actionShowModule()
    {
        //在模块内部使用一下方法获取模型实例
        $module = \frontend\modules\admin\Module::getInstance();

        //also
        // $module = Yii::$app->controller->module;

        //also get by module ID
        // $module = Yii::$app->getModule('admin');

        var_dump($module);

    }
}
