<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CarExperience */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'car_id',
        'agency_id',
        'item_1',
        'item_2',
        'item_11',
        'item_12',
        'item_13',
        'item_14',
        'item_15',
        'item_16',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>

