<?php

namespace backend\controllers;

use Yii;
use backend\models\search\CarInfoSearch;
use backend\models\CarInfo;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
/**
 * CarInfoController implements the CRUD actions for CarInfo model.
 */
class CarInfoController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    $searchModel = new CarInfoSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => CarInfo::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => CarInfo::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => CarInfo::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => CarInfo::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => CarInfo::className(),
            ],
        ];
    }
}
