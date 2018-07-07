<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%car_experience}}".
 *
 * @property int $id 自增id
 * @property int $car_id 车型ID
 * @property int $agency_id 经销商ID
 * @property int $item_1 静态体验是否完成,0-N 1-Y
 * @property int $item_2 动态体验是否完成,0-N 1-Y
 * @property int $item_11 静态体验-普通音箱是否完成,0-N 1-Y
 * @property int $item_12 静态体验-BOSE音箱真实是否完成,0-N 1-Y
 * @property int $item_13 静态体验-BOSE音箱环绕是否完成,0-N 1-Y
 * @property int $item_14 静态体验-BOSE音箱高低是否完成,0-N 1-Y
 * @property int $item_15 静态体验-空调是否完成,0-N 1-Y
 * @property int $item_16 静态体验-噪音是否完成,0-N 1-Y
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class CarExperience extends \yii\db\ActiveRecord
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
        return '{{%car_experience}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'agency_id'], 'required'],
            [['car_id', 'agency_id', 'item_1', 'item_2', 'item_11', 'item_12', 'item_13', 'item_14', 'item_15', 'item_16', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'car_id' => Yii::t('app', 'Car ID'),
            'agency_id' => Yii::t('app', 'Agency ID'),
            'item_1' => Yii::t('app', 'Item 1'),
            'item_2' => Yii::t('app', 'Item 2'),
            'item_11' => Yii::t('app', 'Item 11'),
            'item_12' => Yii::t('app', 'Item 12'),
            'item_13' => Yii::t('app', 'Item 13'),
            'item_14' => Yii::t('app', 'Item 14'),
            'item_15' => Yii::t('app', 'Item 15'),
            'item_16' => Yii::t('app', 'Item 16'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
