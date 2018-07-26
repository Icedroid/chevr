<?php

namespace backend\models;

use Yii;
use common\helpers\Util;

class CarInfo extends \common\models\CarInfo
{
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
