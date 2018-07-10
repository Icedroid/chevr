<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\libs\Constants;

/* @var $this yii\web\View */
/* @var $model backend\models\CarAgency */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Agency'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'account_code',
        'account_name',
        'brand_code',
        'doss_brand_id',
        'mobile',
        'position_code',
        'position_id',
        'position_name',
        'sale_code',
        'service_code',
        'store_code',
        'store_name',
        'store_short_name',
        'area',
        'province',
        'city',
        'access_token',
        'login_count',
        'last_login_time:datetime',
        [
            'attribute' => 'status',
            'value' => function($model){
                return Constants::getStatusItems($model->status);
            }
        ],
        'created_at:datetime',
        'updated_at:time',
    ],
]) ?>

