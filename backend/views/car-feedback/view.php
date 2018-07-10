<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CarFeedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Feedback'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'agency_id',
        'agency_name',
        'content:ntext',
        [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function ($model, $key) {
                $str = '';
                if($model->image){
                    $arr = explode(\common\models\CarFeedback::MULTI_IMAGE_SEPARATOR, $model->image);
                    foreach($arr as $val){
                        $val = $val ? $val : '';
                        $str .= Html::img($val, ['title'=>$val, 'alt'=>$val, 'style'=>'margin-right:5px']);
                    }
                }
                return $str;
            },
        ],
        'created_at',
    ],
]) ?>
