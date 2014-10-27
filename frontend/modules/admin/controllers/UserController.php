<?php
namespace frontend\modules\admin\controllers;

use frontend\modules\admin\models\LoginForm;
use yii;
use yii\web\Controller as BaseController;

/**
 * this section for learn form and model related
 *
 */
class UserController extends BaseController
{
    public function actionLogin()
    {
        $model = new LoginForm;
        $model->scenario = 'login';
        // return $this->goHome();
        $data = Yii::$app->request->post();
        // var_dump($data);
        // var_dump($model->load($data));
        // $model->attributes = $data;

        if ($model->load($data) && $model->validate()) {
            var_dump($model->attributes);
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['name' => 'light'];
        }

        return $this->render('login.html', ['model' => $model]);
    }

    public function actionValidate()
    {
        $model = new LoginForm;
        //messary assignment
        $model->attributes = \Yii::$app->request->post('LoginForm');

        //validate values
        //1. 从scenarios()中取得当前下scenario的属性[active attributes]
        //2. 根据当前scenario从规则列表找出使用的规则[active rule]
        //3. 使用[active rule]校验相应的[active attribute],有错放到error属性中
        $model->validate();
    }

    public function actionAdhoc($name, $email)
    {
        // $email = 'test@examplet.com';
        $validator = new \yii\web\validators\EmailValidator();
        if ($validator->validate($email, $error)) {
            echo 'Email is valid';
        } else {
            echo $error;
        }

        $model = \yii\base\DynamicModel::validateData(compact($name, $email), [
            [['name', 'email'], 'string', 'max' => 128],
            ['email', 'email']
        ]);
        if ($model->hasErrors()) {
            var_dump($model->errors);
        }

        $model = new \yii\base\DynamicModel(compact($name, $email));

        $model->addRule(['name', 'email'], 'string', ['max' => 128])
            ->addRule('email', 'email')
            ->validate();

        if ($model->hasErrors()) {
            var_dump($model->errors);
        }
    }
}
