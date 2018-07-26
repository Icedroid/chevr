<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%car_store}}".
 *
 * @property int $id
 * @property string $store_name 店面名称
 * @property string $area 大区名称
 * @property string $province 省
 * @property string $city 市
 */
class CarStore extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_store}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_name', 'area', 'province', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'store_name' => Yii::t('app', 'Store Name'),
            'area' => Yii::t('app', 'Area'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
        ];
    }

    public static function getByStoreName($storeName)
    {
        return self::findOne(['store_name'=>$storeName]);
    }

    public static function getAreaByStoreName($storeName)
    {
        $model = self::getByStoreName($storeName);
        return $model->area;
    }

    public static function getProvinceByStoreName($storeName)
    {
        $model = self::getByStoreName($storeName);
        return $model->province;
    }

    public static function getCityByStoreName($storeName)
    {
        $model = self::getByStoreName($storeName);
        return $model->city;
    }
}
