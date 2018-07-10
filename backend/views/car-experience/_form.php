<?php

use backend\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CarExperience */
/* @var $form backend\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'form-horizontal'
                    ]
                ]); ?>
                <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'car_id')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'agency_id')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_1')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_2')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_11')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_12')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_13')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_14')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_15')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'item_16')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'created_at')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'updated_at')->textInput() ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>