<?php
namespace frontend\modules\admin\models;

use yii;
use yii\base\Model;

class LoginForm extends Model
{
    const LEVEL_ONE = 1;

    public $username;
    public $password;
    public $age;

    /**
     * [active rule]是在当前scenario下生效的rule
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [
                ['username', 'password'],
                'required',
                'on' => 'login',
                // 'message' => Yii::t('user', '{attribute} is required')
            ], //指定scenario下生效
            [
                ['username', 'password', 'age'],
                'required', 'on' => 'register'
            ],
            //all,inline validator,默认情况值为空或者已有error则不会调用inline validator
            [
                'password',
                'validatePassword',
                //set false
                'skipOnEmpty' => false,
                'skipOnError' => false
            ],

            //在当前scenario没出现的属性是不能被块赋值的
            [
                'age',
                'safe',
                'when' => function ($model, $attr) {
                    return $model->country == 'USA';
                }
            ],
            //filter
            [
                ['username', 'password'],
                'filter',
                'filter' => 'trim',
                'skipOnArray' => true
            ],
            //handel empty, 不指定value则默认为null
            [
                ['level'],
                'default',
                'value' => self::LEVEL_ONE
            ]
        ];
    }

    /**
     * scenario的使用常常在ActiveRecord时使用
     * 默认情况返回在rules中声明的scenario
     *
     * 当前scenario下的所有属性称为[safe attribute]
     * 只有[safe attribute]在块赋值时被赋值其他则不受影响
     * 如果想让当前scenario的某一属性为[unsafe attribute]，不让其进行块赋值：
     *  eg: 'login' => ['username', 'password', '!secret']
     * 这样secret属性不能被块赋值，只能通过 $model->secret = $secret; 来赋值
     *
     * @return array scenarios
     */
    public function scenarios()
    {
        return [
            'login' => ['username', 'password'],
            'register' => ['username', 'password', 'age']
        ];
    }

    /**
     * 定义属性的显示标签
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('user', 'userName'),
            'password' => Yii::t('user', 'password'),
            'age' => Yii::t('user', 'age')
        ];
    }

    /**
     * validate the password(inline validation for password)
     */
    public function validatePassword($attribute, $params)
    {
        $user = $this->username;
        if ($user != 'light' || $this->$attribute != '123456') {
            $this->addError($attribute, Yii::t('user', 'Incorrect username or password'));
        }
    }

    /**
     *
     * @return boolean whether user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return true;
        } else {
            return false;
        }
    }
}
