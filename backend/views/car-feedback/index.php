<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use common\widgets\JsBlock;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Car Feedback');
$this->params['breadcrumbs'][] = Yii::t('app', 'Car Feedback');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                 <?= Bar::widget(['template' => '{refresh} {delete}']); ?>
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'id',
                        'agency_id',
                        'agency_name',
                        'content:ntext',
                        [
                            'attribute' => 'image',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $column) {
                                $str = '';
                                if($model->image){
                                    $arr = explode(\common\models\CarFeedback::MULTI_IMAGE_SEPARATOR, $model->image);
                                    foreach($arr as $val){
                                        $img = Html::img($val ? $val : '', ['width'=>50, 'height'=>50, 'style'=>'margin-right:5px']);
                                        $str .= Html::a($img, $val ? $val : 'javascript:void(0)', [
                                            'img' => $val ? $val : '',
                                            'class' => 'thumbImg',
                                            'target' => '_blank',
                                        ]);
                                    }
                                }
                                return $str;
                            },
                        ],
                        'created_at:datetime',

                        [
                            'class' => ActionColumn::className(),
                            'template' => '{view-layer} {delete}',
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
        function showImg() {
            t = setTimeout(function () {
            }, 200);
            var url = $(this).attr('img');
            if (url.length == 0) {
                layer.tips('<?=yii::t('app', 'No picture')?>', $(this));
            } else {
                layer.tips('<img style="max-width: 100px;max-height: 60px" src=' + url + '>', $(this));
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
            $('table tr td a.thumbImg').bind('mouseover mouseout', showImg);
            $("input.sort").bind('blur', indexSort);
        });
    </script>
<?php JsBlock::end()?>