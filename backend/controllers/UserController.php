<?php
namespace backend\controllers;

use yii\rest\ActiveController as BaseController;

/**
 * Restful test controller
 */
class UserController extends BaseController
{
    public $modelClass = 'backend\models\UserInfo';
}
