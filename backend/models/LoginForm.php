<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $account;
    public $password;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['account', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account' => Yii::t('app', 'account'),
            'password' => Yii::t('app', 'password')
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $channel_info = $this->getChannelAccount();
            if (!$channel_info || !$channel_info->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            //更新登录IP和时间
            $this->_user->ch_login_ip = Yii::$app->getRequest()->getUserIP();
            $this->_user->ch_login_time = time();
            $this->_user->save();
            return Yii::$app->user->login($this->getChannelAccount());
        } else {
            return false;
        }
    }

    /**
     * 根据account获取channel_info
     *
     * @return ChannelInfo|null
     */
    public function getChannelAccount()
    {
        if ($this->_user === false) {
            $this->_user = ChannelInfo::findByAccount($this->account);
        }

        return $this->_user;
    }
}
