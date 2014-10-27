<?php

namespace frontend\modules\admin;

use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{
    public $controllerNamespace = 'frontend\modules\admin\controllers';

    public $urlPrefix = 'admin';

    // public $layout = '@admin/views/layouts/main.php';

    public $urlRules = [
        '<controller:(test)>/<id:\d+>' => '<controller>/read'
    ];

    public function init()
    {
        // var_dump($this->module->get('urlManager'));
        parent::init();
        $aliases = [
            '@admin' => __DIR__,
            '@view' => '@admin/views'
        ];
        //view
        $this->setAliases($aliases);
        $this->viewPath = '@admin/views';
        $this->layout = false;//'@admin/views/layouts/base.html';
        // var_dump($this);
        // custom initialization code goes here
        \Yii::configure($this, require (__DIR__ . '/config/web.php'));
    }

    public function bootstrap($app)
    {
        $module = $app->getModule('admin');

        // var_dump($module);
        // var_dump($app);

        $configUrlRule = [
            'prefix' => $this->urlPrefix,
            'rules' => $this->urlRules
        ];

        // var_dump($app->get('urlManager'));
        $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);
    }
}
