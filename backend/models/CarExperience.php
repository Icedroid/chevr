<?php

namespace backend\models;

use Yii;
use common\helpers\Util;

class CarExperience extends \common\models\CarExperience
{
    public $count;

    public function getFinishPercentage()
    {
        if(null === $this->carInfo){
            return '';
        }
        if($this->carInfo->voice_type == CarInfo::VOICE_TYPE_SIMPLE){
            return intval(($this->item_11 + $this->item_15 + $this->item_16 + $this->item_2) / 4 * 100) . '%';
        }else{
            return intval(($this->item_12 + $this->item_13 + $this->item_14 + $this->item_15 + $this->item_16 + $this->item_2) / 6 * 100) . '%';
        }
    }
}
