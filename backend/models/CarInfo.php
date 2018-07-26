<?php

namespace backend\models;

use Yii;
use common\helpers\Util;

class CarInfo extends \common\models\CarInfo
{
    const VOICE_TYPE_SIMPLE = 0; //普通音箱
    const VOICE_TYPE_BOSE = 1; //BOSE音箱
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        Util::handleModelSingleFileUpload($this, 'image', $insert, '@car');
        Util::handleModelSingleFileUpload($this, 'h5image', $insert, '@car');

        return parent::beforeSave($insert);
    }
}
