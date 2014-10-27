<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $u_id
 * @property integer $ch_id
 * @property integer $u_oid
 * @property integer $u_ctime
 * @property integer $u_btime
 * @property integer $u_source
 * @property integer $is_attentioned
 * @property double $u_balance
 * @property string $u_jifen
 * @property string $u_zipcode
 * @property string $u_email
 * @property string $u_phone
 * @property string $hy_auth_uid
 * @property string $hy_auth_uid_creditcard
 * @property string $u_openid
 * @property string $u_province
 * @property string $u_city
 * @property string $u_district
 * @property string $u_area
 * @property string $u_password
 * @property string $u_name
 * @property string $u_consignee
 * @property string $u_account
 * @property string $u_address
 * @property integer $u_sex
 * @property string $u_birthday
 * @property string $u_remain_jifen
 * @property integer $u_inviter
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ch_id', 'u_ctime'], 'required'],
            [['ch_id', 'u_oid', 'u_ctime', 'u_btime', 'u_source', 'is_attentioned', 'u_jifen', 'u_sex', 'u_remain_jifen', 'u_inviter'], 'integer'],
            [['u_balance'], 'number'],
            [['u_zipcode'], 'string', 'max' => 20],
            [['u_email', 'u_phone', 'hy_auth_uid', 'hy_auth_uid_creditcard'], 'string', 'max' => 50],
            [['u_openid', 'u_province', 'u_city', 'u_district', 'u_area', 'u_password'], 'string', 'max' => 100],
            [['u_name', 'u_consignee', 'u_account'], 'string', 'max' => 200],
            [['u_address'], 'string', 'max' => 1000],
            [['u_birthday'], 'string', 'max' => 10],
            [['u_phone'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'u_id' => Yii::t('user', 'U ID'),
            'ch_id' => Yii::t('user', 'Ch ID'),
            'u_oid' => Yii::t('user', 'U Oid'),
            'u_ctime' => Yii::t('user', 'U Ctime'),
            'u_btime' => Yii::t('user', 'U Btime'),
            'u_source' => Yii::t('user', '1. 微信粉丝 2. 微信注册用户 3. 手动录入用户'),
            'is_attentioned' => Yii::t('user', '是否处于微信关注状态1. 关注中 2. 未关注'),
            'u_balance' => Yii::t('user', 'U Balance'),
            'u_jifen' => Yii::t('user', 'U Jifen'),
            'u_zipcode' => Yii::t('user', 'U Zipcode'),
            'u_email' => Yii::t('user', 'U Email'),
            'u_phone' => Yii::t('user', 'U Phone'),
            'hy_auth_uid' => Yii::t('user', 'Hy Auth Uid'),
            'hy_auth_uid_creditcard' => Yii::t('user', 'Hy Auth Uid Creditcard'),
            'u_openid' => Yii::t('user', 'U Openid'),
            'u_province' => Yii::t('user', 'U Province'),
            'u_city' => Yii::t('user', 'U City'),
            'u_district' => Yii::t('user', 'U District'),
            'u_area' => Yii::t('user', 'U Area'),
            'u_password' => Yii::t('user', 'U Password'),
            'u_name' => Yii::t('user', 'U Name'),
            'u_consignee' => Yii::t('user', 'U Consignee'),
            'u_account' => Yii::t('user', 'U Account'),
            'u_address' => Yii::t('user', 'U Address'),
            'u_sex' => Yii::t('user', 'U Sex'),
            'u_birthday' => Yii::t('user', 'U Birthday'),
            'u_remain_jifen' => Yii::t('user', 'U Remain Jifen'),
            'u_inviter' => Yii::t('user', 'U Inviter'),
        ];
    }
}
