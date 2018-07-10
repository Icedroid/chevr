<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
use backend\grid\StatusColumn;
use common\libs\Constants;
use common\widgets\JsBlock;
use backend\grid\DateColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Car Agency');
$this->params['breadcrumbs'][] = Yii::t('app', 'Car Agency');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
<!--                --><?//= Bar::widget() ?>
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        'account_code',
                        'account_name',
//                        'brand_code',
//                        'doss_brand_id',
                         'mobile',
                        // 'position_code',
                        // 'position_id',
                        'position_name',
                        // 'sale_code',
                        // 'service_code',
                        // 'store_code',
                        'store_name',
                        // 'store_short_name',
                        // 'area',
                        // 'province',
                        // 'city',
                        'access_token',
                        'login_count',
                        [
                            'class' => DateColumn::className(),
                            'attribute' => 'last_login_time',
                        ],
//                        'last_login_time:datetime',
                        [
                            'class' => StatusColumn::className(),
                            'attribute' => 'status',
                            'text' => function ($model, $key, $index, $column) {
                                return Constants::getStatusItems($model->status);
                            },
                            'filter' => Constants::getStatusItems(),
                        ],
                        // 'created_at',
                        // 'updated_at',

                        [
                            'class' => ActionColumn::className(),
                            'template' => '{view-layer}',
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php JsBlock::begin()?>
    <script>
        var container = $('#pjax');
        container.on('pjax:send',function(args){
            layer.load(2);
        });
        container.on('pjax:complete',function(args){
            layer.closeAll('loading');
        });
    </script>
<?php JsBlock::end()?>