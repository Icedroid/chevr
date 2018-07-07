<?php
namespace api\modules\v1\models;

use Yii;
class CarExperience extends \common\models\CarExperience
{
    public function beforeValidate()
    {
        if(!Yii::$app->getUser()->getIsGuest()){
            $this->agency_id = Yii::$app->getUser()->getIdentity()->getId();
        }
        return parent::beforeValidate();
    }
}