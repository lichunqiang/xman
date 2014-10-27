<?php
namespace backend\models;

use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean', 'on' => ['login']],
            // password is validated by validatePassword()
            ['password', 'validatePassword', 'on' => ['login']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'login' => ['username', 'password', 'rememberMe'],
            'register' => ['username', 'password', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'username'),
            'password' => Yii::t('app', 'password'),
            'rememberMe' => Yii::t('app', 'rememberMe'),
            'email' => Yii::t('app', 'email'),
        ];
    }

    /**
     * [[yii\base\Model::toArray()]]放回的字段
     */
    public function fields()
    {
        //1. 过滤敏感字段
        $fields = parent::fields();
        unset($fields['auth_key'], $fields['password_hash']);
        return $fields;
        //定制放回
        return [
            //字段名和属性名一致
            'id',
            //字段名是email，对应的属性为email_address
            'email' => 'email_address',
            'name' => function () {
                return $this->first_name . ' ' . $this->last_name;
            }
        ];
    }

    public function validatePassword($attribute, $params)
    {

    }
}
