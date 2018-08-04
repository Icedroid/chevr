<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CarInfo */
/* @var $form backend\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal'
                    ]
                ]); ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'image')->imgInput(['style' => 'max-width:200px;max-height:200px'])->hint('请上传510*360的图片', ['class' => 'col-sm-2 control-label text-info']); ?>
                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'h5image')->imgInput(['style' => 'max-width:200px;max-height:200px'])->hint('请上传640*510的图片', ['class' => "col-sm-2 control-label text-info"]); ?>
                <div class="hr-line-dashed">

                </div><?= $form->field($model, 'slogan')->imgInput(['style' => 'max-width:200px;max-height:200px'])->hint('请上传640*220的图片', ['class' => "col-sm-2 control-label text-info"]); ?>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <?= $form->field($model, 'voice_type')->checkbox() ?>
                </div>
                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'sort')->textInput() ?>
                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'status')->radioList(\common\libs\Constants::getStatusItems()) ?>
                <div class="hr-line-dashed"></div>

                <?= $form->defaultButtons() ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>