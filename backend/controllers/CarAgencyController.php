<?php

namespace backend\controllers;

use backend\models\search\CarAgencySearch;
use Yii;
use backend\models\CarAgency;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\ViewAction;
use yii\data\ActiveDataProvider;

/**
 * CarAgencyController implements the CRUD actions for CarAgency model.
 */
class CarAgencyController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    $searchModel = new CarAgencySearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => CarAgency::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => CarAgency::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => CarAgency::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => CarAgency::className(),
            ],
        ];
    }
}
