<?php

use backend\widgets\Bar;
use common\widgets\JsBlock;
use yii\widgets\Pjax;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use backend\grid\DateColumn;
use backend\grid\SortColumn;
use backend\grid\StatusColumn;
use yii\helpers\Html;
use common\libs\Constants;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CarInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Car Info');
$this->params['breadcrumbs'][] = Yii::t('app', 'Car Info');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?php Pjax::begin(['id' => 'pjax']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        'name',
                        [
                            'class' => SortColumn::className(),
                        ],
                        [
                            'attribute' => 'image',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $column) {
                                return Html::img($model->image ? $model->image : '');
                            },
                        ],
                        [
                            'attribute' => 'h5image',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $column) {
                                if ($model->h5image == '') {
                                    $num = Constants::YesNo_No;
                                } else {
                                    $num = Constants::YesNo_Yes;
                                }
                                return Html::a(Constants::getYesNoItems($num), $model->h5image ? $model->h5image : 'javascript:void(0)', [
                                    'img' => $model->h5image ? $model->h5image : '',
                                    'class' => 'thumbImg',
                                    'target' => '_blank',
                                ]);
                            },
                        ],
                        [
                            'class' =>StatusColumn::className(),
                            'attribute' => 'voice_type',
                            'filter' => Constants::getYesNoItems(),
                        ],
                        [
                            'class' =>StatusColumn::className(),
                            'attribute' => 'status',
                            'text' => function ($model, $key, $index, $column) {
                                return Constants::getStatusItems($model->status);
                            },
                            'filter' => Constants::getStatusItems(),
                        ],
                        [
                            'class' => DateColumn::className(),
                            'attribute' => 'created_at',
                        ],
                        [
                            'class' => DateColumn::className(),
                            'attribute' => 'updated_at',
                        ],

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php JsBlock::begin()?>
    <script>
        function showImg() {
            t = setTimeout(function () {
            }, 200);
            var url = $(this).attr('img');
            if (url.length == 0) {
                layer.tips('<?=yii::t('app', 'No picture')?>', $(this));
            } else {
                layer.tips('<img style="max-width: 500px;max-height: 300px" src=' + url + '>', $(this));
            }
        }
        $(document).ready(function(){
            var t;
            $('table tr td a.thumbImg').hover(showImg,function(){
                clearTimeout(t);
            });
        });
        var container = $('#pjax');
        container.on('pjax:send',function(args){
            layer.load(2);
        });
        container.on('pjax:complete',function(args){
            layer.closeAll('loading');
            $("input.sort").bind('blur', indexSort);
        });
    </script>
<?php JsBlock::end()?>