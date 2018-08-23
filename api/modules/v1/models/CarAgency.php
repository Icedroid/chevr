<?php
namespace api\modules\v1\models;

use api\modules\v1\models\form\LoginForm;
use yii\web\IdentityInterface;

class CarAgency extends \common\models\CarAgency implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * set attributes value by loginForm model
     *
     * @param LoginForm
     */
    public function setAttributesByLoginForm($model)
    {
//        if(isset($model->access_token)){
//            $this->access_token = $model->access_token;
//        }
        if(isset($model->accountCode)){
            $this->account_code = $model->accountCode;
        }
        if(isset($model->accountName)){
            $this->account_name = $model->accountName;
        }
        if(isset($model->brandCode)){
            $this->brand_code = $model->brandCode;
        }
        if(isset($model->mobile)){
            $this->mobile = $model->mobile;
        }
        if(isset($model->dossBrandId)){
            $this->doss_brand_id = $model->dossBrandId;
        }
        if(isset($model->positionCode)){
            $this->position_code = $model->positionCode;
        }
        if(isset($model->positionId)){
            $this->position_id = $model->positionId;
        }
        if(isset($model->positionName)){
            $this->position_name = $model->positionName;
        }
        if(isset($model->saleCode)){
            $this->sale_code = $model->saleCode;
        }
        if(isset($model->serviceCode)){
            $this->service_code = $model->serviceCode;
        }
        if(isset($model->storeCode)){
            $this->store_code = $model->storeCode;
        }
        if(isset($model->storeName)){
            $this->store_name = $model->storeName;
        }
        if(isset($model->storeShortName)){
            $this->store_short_name = $model->storeShortName;
        }
    }

    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->access_token;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by account_code
     *
     * @param string $accountCode
     * @return static|null
     */
    public static function findByAccountCode($accountCode)
    {
        return static::findOne(['account_code' => $accountCode, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by mobile
     *
     * @param string $mobile
     * @return static|null
     */
    public static function findByMobile($mobile)
    {
        return static::findOne(['mobile' => $mobile, 'status' => self::STATUS_ACTIVE]);
    }

}