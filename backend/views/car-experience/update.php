<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\CarExperience */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Car Experience'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Car Experience')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
