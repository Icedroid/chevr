<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\CarAgency */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Car Agency'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Car Agency')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
