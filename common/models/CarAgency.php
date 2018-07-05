<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%car_agency}}".
 *
 * @property int $id 经销商ID
 * @property string $nickname 经销商名称
 * @property string $identity 用户身份，如销售、试驾专员
 * @property string $area 所属区域
 * @property string $province 所属省
 * @property string $city 所属城市
 * @property int $login_count 用户登录次数
 * @property int $last_login_time 最后登录时间
 * @property int $status 用户状态,1为正常
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class CarAgency extends \yii\db\ActiveRecord
{
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
            [['id', 'nickname', 'identity', 'area', 'province', 'city'], 'required'],
            [['id', 'login_count', 'last_login_time', 'status', 'created_at', 'updated_at'], 'integer'],
            [['nickname', 'identity', 'area', 'province', 'city'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nickname' => Yii::t('app', 'Nickname'),
            'identity' => Yii::t('app', 'Identity'),
            'area' => Yii::t('app', 'Area'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'login_count' => Yii::t('app', 'Login Count'),
            'last_login_time' => Yii::t('app', 'Last Login Time'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
