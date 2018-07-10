<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\CarInfo */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Car Info'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') . yii::t('app', 'Car Info')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

