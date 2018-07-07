<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "{{%car_agency}}".
 *
 * @property int $id 主键
 * @property string $account_code 经销商代码
 * @property string $account_name 经销商名称
 * @property int $brand_code
 * @property int $doss_brand_id
 * @property string $mobile 手机号
 * @property string $position_code
 * @property string $position_id
 * @property string $position_name 用户身份，如销售、试驾专员
 * @property string $sale_code
 * @property string $service_code
 * @property int $store_code 店面编号
 * @property string $store_name 店面公司名
 * @property string $store_short_name 店面公司短名称
 * @property string $area 所属区域
 * @property string $province 所属省
 * @property string $city 所属城市
 * @property string $access_token 访问token
 * @property int $login_count 用户登录次数
 * @property int $last_login_time 最后登录时间
 * @property int $status 用户状态,0-禁用 1-正常
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class CarAgency extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_agency}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_code', 'account_name', 'access_token'], 'required'],
            [['brand_code', 'doss_brand_id', 'store_code', 'login_count', 'last_login_time', 'status', 'created_at', 'updated_at'], 'integer'],
            [['account_code', 'account_name', 'position_code', 'position_id', 'position_name', 'sale_code', 'service_code', 'store_name', 'store_short_name', 'area', 'province', 'city', 'access_token'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 11],
//            [['mobile'], 'unique'],
            [['access_token'], 'unique'],
            [['account_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'account_code' => Yii::t('app', 'Account Code'),
            'account_name' => Yii::t('app', 'Account Name'),
            'brand_code' => Yii::t('app', 'Brand Code'),
            'doss_brand_id' => Yii::t('app', 'Doss Brand ID'),
            'mobile' => Yii::t('app', 'Mobile'),
            'position_code' => Yii::t('app', 'Position Code'),
            'position_id' => Yii::t('app', 'Position ID'),
            'position_name' => Yii::t('app', 'Position Name'),
            'sale_code' => Yii::t('app', 'Sale Code'),
            'service_code' => Yii::t('app', 'Service Code'),
            'store_code' => Yii::t('app', 'Store Code'),
            'store_name' => Yii::t('app', 'Store Name'),
            'store_short_name' => Yii::t('app', 'Store Short Name'),
            'area' => Yii::t('app', 'Area'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'access_token' => Yii::t('app', 'Access Token'),
            'login_count' => Yii::t('app', 'Login Count'),
            'last_login_time' => Yii::t('app', 'Last Login Time'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
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
        return $this->access_token;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
