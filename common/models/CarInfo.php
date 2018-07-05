<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%car_info}}".
 *
 * @property int $id 自增id
 * @property string $name 车型名称
 * @property string $image 图片url
 * @property int $voice_type 音箱类型.0普通,1BOSE
 * @property int $sort 排序
 * @property int $status 状态.0禁用,1启用
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 */
class CarInfo extends \yii\db\ActiveRecord
{
    const STATUS_FORBIDDEN = 0;
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
        return '{{%car_info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['voice_type', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'),
            'voice_type' => Yii::t('app', 'Voice Type'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($this->image) {
            /** @var TargetAbstract $cdn */
            $cdn = yii::$app->get('cdn');
            $this->image = $cdn->getCdnUrl($this->image);
        }
    }

    public function beforeSave($insert)
    {
        if ($this->image) {
            /** @var TargetAbstract $cdn */
            $cdn = yii::$app->get('cdn');
            $this->image = str_replace($cdn->host, '', $this->image);
        }
        return parent::beforeSave($insert);
    }
}
