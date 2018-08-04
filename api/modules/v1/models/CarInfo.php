<?php
namespace api\modules\v1\models;

use Yii;
class CarInfo extends \common\models\CarInfo
{
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['status'], $fields['created_at'], $fields['updated_at']);
//        $fields['image'] = function ($model) {
//            if( empty($this->image) ) return '';
//            if ( strpos($this->image, 'http') === 0 || strpos($this->image, 'https') === 0){
//                return $this->image;
//            }
//
//            if( strpos($this->image, '/') === 0 ){
//                $this->image = substr($this->image, 1);
//            }
//            return Yii::$app->request->hostInfo.DIRECTORY_SEPARATOR.$this->image;
//        };
        return $fields;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->image = $this->getFileRightUrl($this->image);
        $this->h5image = $this->getFileRightUrl($this->h5image);
        $this->slogan = $this->getFileRightUrl($this->slogan);
    }

    public function getFileRightUrl($file)
    {
        if( empty($file) ) return '';
        if ( strpos($file, 'http') === 0 || strpos($file, 'https') === 0){
            return $file;
        }

        if( strpos($file, '/') === 0 ){
            $file = substr($file,1);
        }
        $hostUrl = Yii::$app->getRequest()->getHostInfo();
        if(isset(Yii::$app->params['staticCdn']) && !empty(Yii::$app->params['staticCdn'])){
            $hostUrl = Yii::$app->params['staticCdn'];
        }
        return rtrim($hostUrl, '/').'/'.$file;
    }
}