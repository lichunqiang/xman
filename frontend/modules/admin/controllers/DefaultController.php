<?php

namespace frontend\modules\admin\controllers;

use yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        // var_dump(Yii::$app);
        // echo Yii::t('app', 'title');
        $cache = Yii::$app->fcache;
        // var_dump($cache);
        return $this->render('index');
    }
}
