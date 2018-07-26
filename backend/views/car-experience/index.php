<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
use backend\grid\StatusColumn;
use common\libs\Constants;
use backend\grid\DateColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CarExperienceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Car Experiences');
$this->params['breadcrumbs'][] = Yii::t('app', 'Car Experiences');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget(['template' => '{refresh} {delete}']) ?>
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
//                        ['class' => CheckboxColumn::className()],

//                        'id',
//                        'car_id',
                        [
                            'attribute' => 'account_name',
                            'label' => yii::t('app', 'Account Name'),
                            'value' => function ($model) {
                                return null !== $model->carAgency ? $model->carAgency->account_name : '';
                            }
                        ],
                        [

                            'label' => yii::t('app', 'Position Name'),
                            'value' => function ($model) {
                                return null !== $model->carAgency ? $model->carAgency->position_name : '';
                            }
                        ],
                        [
                            'class' => DateColumn::className(),
                            'attribute' => 'created_at',
                            'format' => ['datetime', 'php:Y-m-d'],
                        ],
                        [
                            'attribute' => 'car_name',
                            'label' => yii::t('app', 'Car Name'),
                            'value' => function ($model) {
                                return null !== $model->carInfo ? $model->carInfo->name : '';
                            }
                        ],
//                        'agency_id',

//                        [
//                            'attribute' => 'item_1',
//                            'format' => 'html',
//                            'value' => function ($model) {
//                             return $model->item_1 ? '&#10003;' : '&#10005';
//                            },
//                            'filter' => Constants::getFinishStatusItems(),
//                        ],

                        [
                            'attribute' => 'item_11',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->item_11 ? '&#10003;' : '&#10005';
                            },
                            'filter' => Constants::getFinishStatusItems(),
                        ],
                        [
                            'attribute' => 'item_12',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->item_12 ? '&#10003;' : '&#10005';
                            },
                            'filter' => Constants::getFinishStatusItems(),
                        ],
                        [
                            'attribute' => 'item_13',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->item_13 ? '&#10003;' : '&#10005';
                            },
                            'filter' => Constants::getFinishStatusItems(),
                        ],
                        [
                            'attribute' => 'item_14',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->item_14 ? '&#10003;' : '&#10005';
                            },
                            'filter' => Constants::getFinishStatusItems(),
                        ],
                        [
                            'attribute' => 'item_15',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->item_15 ? '&#10003;' : '&#10005';
                            },
                            'filter' => Constants::getFinishStatusItems(),
                        ],
                        [
                            'attribute' => 'item_16',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->item_16 ? '&#10003;' : '&#10005';
                            },
                            'filter' => Constants::getFinishStatusItems(),
                        ],
                        [
                            'attribute' => 'item_2',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->item_2 ? '&#10003;' : '&#10005';
                            },
                            'filter' => Constants::getFinishStatusItems(),
                        ],
                        // 'updated_at',
                        [
                            'label' => yii::t('app', 'Experience Percentage'),
                            'value' => function ($model) {
                                return $model->getFinishPercentage();
                            }
                        ],

//                        [
//                            'class' => ActionColumn::className(),
//                            'template' => '{view-layer} {delete}',
//                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
