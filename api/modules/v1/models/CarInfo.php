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
        if( empty($this->image) ) return ;
        if ( strpos($this->image, 'http') === 0 || strpos($this->image, 'https') === 0){
            return ;
        }

        if( strpos($this->image, '/') === 0 ){
            $this->image = substr($this->image, 1);
        }
        $hostUrl = Yii::$app->getRequest()->getHostInfo();
        if(isset(Yii::$app->params['staticCdn']) && !empty(Yii::$app->params['staticCdn'])){
            $hostUrl = Yii::$app->params['staticCdn'];
        }
        $this->image = rtrim($hostUrl, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$this->image;
    }
}