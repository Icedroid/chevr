<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\libs\Constants;

/* @var $this yii\web\View */
/* @var $model backend\models\CarInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Info'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function($model){
                return "<img style='max-width:200px;max-height:200px' src='" . $model->image . "' >";
            }
        ],
        [
            'attribute' => 'voice_type',
            'value' => function($model){
                return Constants::getYesNoItems($model->voice_type);
            }
        ],
        'sort',
        [
            'attribute' => 'status',
            'value' => function($model){
                return Constants::getStatusItems($model->status);
            }
        ],
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>

