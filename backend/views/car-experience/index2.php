<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
use backend\grid\StatusColumn;
use common\libs\Constants;
use backend\grid\DateColumn;
use backend\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CarExperienceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Car Experiences2');
$this->params['breadcrumbs'][] = Yii::t('app', 'Car Experiences2');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $columns = [
//                        ['class' => CheckboxColumn::className()],

                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => '序号',
                        'headerOptions' => ['width' => '60px'],
                    ],
                    [
                        'attribute' => 'area',
                        'label' => yii::t('app', 'Area'),
                        'value' => function ($model) {
                            return \backend\models\CarStore::getAreaByStoreName($model->carAgency->store_name);
                        }
                    ],
                    [
                        'attribute' => 'province',
                        'label' => yii::t('app', 'Province'),
                        'value' => function ($model) {
                            return \backend\models\CarStore::getProvinceByStoreName($model->carAgency->store_name);
                        }
                    ],
                    [
                        'attribute' => 'city',
                        'label' => yii::t('app', 'City'),
                        'value' => function ($model) {
                            return \backend\models\CarStore::getCityByStoreName($model->carAgency->store_name);
                        }
                    ],

                    [
                        'attribute' => 'account_name',
                        'label' => yii::t('app', 'Account Name'),
                        'value' => function ($model) {
                            return $model->carAgency->account_name;
                        }
                    ],
//                        [
//                            'attribute' => 'car_name',
//                            'label' => yii::t('app', 'Car Name'),
//                            'value' => function ($model) {
//                                return $model->carInfo->name;
//                            }
//                        ],
                    [
                        'label' => yii::t('app', 'count'),
                        'value' => function ($model) {
                            return $model->count;
                        }
                    ],
                    [
                        'attribute' => 'item_11',
                    ],
                    [
                        'label' => yii::t('app', 'Use Percentage'),
                        'value' => function ($model) {
                            return intval($model->item_11 / $model->count * 100) . '%';
                        }
                    ],
                    [
                        'attribute' => 'item_12',
                    ],
                    [
                        'label' => yii::t('app', 'Use Percentage'),
                        'value' => function ($model) {
                            return intval($model->item_12 / $model->count * 100) . '%';
                        }
                    ],

                    [
                        'attribute' => 'item_13',
                    ],
                    [
                        'label' => yii::t('app', 'Use Percentage'),
                        'value' => function ($model) {
                            return intval($model->item_13 / $model->count * 100) . '%';
                        }
                    ],

                    [
                        'attribute' => 'item_14',
                    ],
                    [
                        'label' => yii::t('app', 'Use Percentage'),
                        'value' => function ($model) {
                            return intval($model->item_14 / $model->count * 100) . '%';
                        }
                    ],

                    [
                        'attribute' => 'item_15',
                    ],
                    [
                        'label' => yii::t('app', 'Use Percentage'),
                        'value' => function ($model) {
                            return intval($model->item_15 / $model->count * 100) . '%';
                        }
                    ],

                    [
                        'attribute' => 'item_16',
                    ],
                    [
                        'label' => yii::t('app', 'Use Percentage'),
                        'value' => function ($model) {
                            return intval($model->item_16 / $model->count * 100) . '%';
                        }
                    ],


                ]; ?>
                <?= Bar::widget(['template' => '{refresh}']) ?>
                <?php
                //echo "车型：";
                $models = $dataProvider->getModels();
                if (!empty($models)) {
                    $model = $models[0];
                    $searchModel->car_name = $model->carInfo->name;
                }
                ?>

                <?php $form = ActiveForm::begin([
                    'id' => 'search-form',
                    'method' => 'GET',
                    'options' => [
                        'class' => 'form-horizontal'
                    ]
                ]);

                echo $form->field($searchModel, 'car_name', ['options' => ['class' => 'col-sm-8']])->label(yii::t('app', 'Car Name'));

                echo '<div class="form-group" style="float: left">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit">' . Yii::t('app', 'Search') . '</button>
                    </div>
                </div>';

                ActiveForm::end();
                ?>
                <?= ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $columns,
                    'emptyText' => Yii::t('app', 'No Data'),

                    'asDropdown' => true,
                    'clearBuffers' => true,
                    'container' => ['class'=>'mail-tools tooltip-demo m-t-md', 'style'=>'float:right; margin-right:5px'],
                    'columnSelectorOptions' => ['class'=>'btn btn-white btn-sm'],
                    'dropdownOptions' => ['class'=>'btn btn-white btn-sm'],
                    'columnSelectorMenuOptions'=>['style'=> 'min-width: 120px; padding: 0 10px;'],
                    'exportColumnsView' =>'/widgets/_export_columns',

                    'exportConfig' => [
                      ExportMenu::FORMAT_HTML => false,

                    ],

                ]);
                ?>

                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//                    'filterModel' => $searchModel,
                    'columns' => $columns,
                ]); ?>
                <?php Pjax::end(); ?>            </div>
        </div>
    </div>
</div>
