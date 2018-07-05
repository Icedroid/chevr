<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%car_feedback}}".
 *
 * @property int $id 自增id
 * @property int $agency_id 经销商ID
 * @property string $agency_name 经销商名称
 * @property string $content 内容
 * @property string $image 多张用;分隔
 * @property int $created_at 创建时间
 */
class CarFeedback extends \yii\db\ActiveRecord
{
    const MULTI_IMAGE_SEPARATOR = ";";

    public function behaviors()
    {
//        return [
//            \yii\behaviors\TimestampBehavior::className(),
//        ];
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car_feedback}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agency_id', 'agency_name', 'content', 'image'], 'required'],
            [['agency_id', 'created_at'], 'integer'],
            [['content', 'image'], 'string'],
            [['agency_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'agency_id' => Yii::t('app', 'Agency ID'),
            'agency_name' => Yii::t('app', 'Agency Name'),
            'content' => Yii::t('app', 'Content'),
            'image' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
