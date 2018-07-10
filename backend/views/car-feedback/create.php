<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\CarFeedback */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Car Feedback'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') . yii::t('app', 'Car Feedback')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

