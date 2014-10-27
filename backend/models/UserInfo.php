<?php

namespace backend\models;

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
            'u_id' => Yii::t('app', 'U ID'),
            'ch_id' => Yii::t('app', 'Ch ID'),
            'u_oid' => Yii::t('app', 'U Oid'),
            'u_ctime' => Yii::t('app', 'U Ctime'),
            'u_btime' => Yii::t('app', 'U Btime'),
            'u_source' => Yii::t('app', 'U Source'),
            'is_attentioned' => Yii::t('app', 'Is Attentioned'),
            'u_balance' => Yii::t('app', 'U Balance'),
            'u_jifen' => Yii::t('app', 'U Jifen'),
            'u_zipcode' => Yii::t('app', 'U Zipcode'),
            'u_email' => Yii::t('app', 'U Email'),
            'u_phone' => Yii::t('app', 'U Phone'),
            'hy_auth_uid' => Yii::t('app', 'Hy Auth Uid'),
            'hy_auth_uid_creditcard' => Yii::t('app', 'Hy Auth Uid Creditcard'),
            'u_openid' => Yii::t('app', 'U Openid'),
            'u_province' => Yii::t('app', 'U Province'),
            'u_city' => Yii::t('app', 'U City'),
            'u_district' => Yii::t('app', 'U District'),
            'u_area' => Yii::t('app', 'U Area'),
            'u_password' => Yii::t('app', 'U Password'),
            'u_name' => Yii::t('app', 'U Name'),
            'u_consignee' => Yii::t('app', 'U Consignee'),
            'u_account' => Yii::t('app', 'U Account'),
            'u_address' => Yii::t('app', 'U Address'),
            'u_sex' => Yii::t('app', 'U Sex'),
            'u_birthday' => Yii::t('app', 'U Birthday'),
            'u_remain_jifen' => Yii::t('app', 'U Remain Jifen'),
            'u_inviter' => Yii::t('app', 'U Inviter'),
        ];
    }
}
