<?php
namespace api\modules\v1\models;

use Yii;
use yii\helpers\Json;

class CarFeedback extends \common\models\CarFeedback
{
    public function beforeValidate()
    {
        if(!Yii::$app->getUser()->getIsGuest()){
            $this->agency_id = Yii::$app->getUser()->getIdentity()->getId();
//                $this->agency_name = Yii::$app->getUser()->getIdentity()->username;
            $this->agency_name = Yii::$app->getUser()->getIdentity()->account_name;
        }else{
            $this->setAttribute('agency_id', 1);
            $this->setAttribute('agency_name', 'test');
        }
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('image', implode(self::MULTI_IMAGE_SEPARATOR, Json::decode($this->image)));
        return parent::beforeSave($insert);
    }
}