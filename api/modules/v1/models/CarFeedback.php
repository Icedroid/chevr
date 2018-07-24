<?php

namespace api\modules\v1\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class CarFeedback extends \common\models\CarFeedback
{
    public function formName()
    {
        return '';
    }

    public function beforeValidate()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            $this->agency_id = Yii::$app->getUser()->getIdentity()->getId();
//                $this->agency_name = Yii::$app->getUser()->getIdentity()->username;
            $this->agency_name = Yii::$app->getUser()->getIdentity()->account_name;
        }
        $uploadArray = UploadedFile::getInstances($this, 'image');
        if (!empty($uploadArray)) {
            $arr = [];
            $uploadPath = yii::getAlias('@feedback');
            if (strpos(strrev($uploadPath), '/') !== 0) $uploadPath .= '/';
            if (!FileHelper::createDirectory($uploadPath)) {
                $this->addError('image', "Create directory failed " . $uploadPath);
                return false;
            }

            foreach ($uploadArray as $upload) {
                $fullName = $uploadPath . date('YmdHis') . '_' . uniqid() . '.' . $upload->getExtension();
                if (!$upload->saveAs($fullName)) {
                    $this->addError('image', yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', ucfirst('image'))]) . ': ' . $fullName);
                    return false;
                }
                $fileRelativeUrl = str_replace(yii::getAlias('@frontend/web'), '', $fullName);

                $arr[] = $fileRelativeUrl;
            }
            $this->image = implode(";", $arr);
        }


//        $imageStreamArray = Json::decode($this->image);
//        foreach ($imageStreamArray as $stream) {
//
//            $filename = $uploadPath.time().'.png';
//            file_put_contents($filename, $stream);
//
//        }

        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
//        $this->setAttribute('image', implode(self::MULTI_IMAGE_SEPARATOR, Json::decode($this->image)));
        return parent::beforeSave($insert);
    }
}