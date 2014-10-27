<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "channel_info".
 *
 * @property integer $ch_id
 * @property integer $ch_type
 * @property integer $ch_parent
 * @property integer $ch_status
 * @property integer $ch_wx_type
 * @property integer $ch_has_menu
 * @property integer $ch_has_high_interface
 * @property integer $ch_ctime
 * @property integer $ch_login_time
 * @property string $ch_heepay_agent
 * @property string $up_id
 * @property string $ch_name
 * @property string $ch_phone
 * @property string $ch_login_ip
 * @property string $ch_password
 * @property string $ch_wx_qrcode
 * @property string $ch_heepay_datakey
 * @property string $ch_heepay_signkey
 * @property string $ch_account
 * @property string $ch_wx_orgid
 * @property string $ch_wx_name
 * @property string $ch_wx_num
 * @property string $ch_wx_appid
 * @property string $ch_wx_token
 * @property string $ch_wx_appsecret
 * @property string $ch_wx_account
 * @property string $ch_wx_pwd
 * @property string $ch_alipay_account
 * @property string $ch_alipay_partner
 * @property string $ch_alipay_key
 * @property string $ch_wepay_signkey
 * @property string $ch_wepay_partnerid
 * @property string $ch_wepay_partnerkey
 * @property string $ch_email
 * @property string $ch_website
 * @property string $ch_logo
 * @property string $ch_service
 */
class ChannelInfo extends ActiveRecord implements IdentityInterface
{
    //账号状态
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'channel_info';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ch_id' => $id, 'ch_status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * 根据account查找用户
     *
     * @param string $username
     * @return static|null
     */
    public static function findByAccount($account)
    {
        return static::findOne(['ch_account' => $account, 'ch_status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return Yii::$app->security->validatePassword($password, $this->password_hash);
        return $this->ch_password === md5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
