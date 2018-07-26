<?php

namespace backend\controllers;

use backend\actions\ViewAction;
use Yii;
use backend\models\search\CarExperienceSearch;
use backend\models\search\CarExperience2Search;
use backend\models\CarExperience;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
/**
 * CarExperienceController implements the CRUD actions for CarExperience model.
 */
class CarExperienceController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    
                        $searchModel = new CarExperienceSearch();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];
                    
                }
            ],
            'index2' => [//车型试驾情况统计
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new CarExperience2Search();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];

                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => CarExperience::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => CarExperience::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => CarExperience::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => CarExperience::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => CarExperience::className(),
            ],
        ];
    }
}
