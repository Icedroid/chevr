<?php

namespace backend\controllers;

use backend\actions\ViewAction;
use Yii;
use backend\models\CarFeedback;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use yii\data\ActiveDataProvider;
/**
 * CarFeedbackController implements the CRUD actions for CarFeedback model.
 */
class CarFeedbackController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    
                        $dataProvider = new ActiveDataProvider([
                            'query' => CarFeedback::find(),
                        ]);

                        return [
                            'dataProvider' => $dataProvider,
                        ];
                    
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => CarFeedback::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => CarFeedback::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => CarFeedback::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => CarFeedback::className(),
            ],
        ];
    }
}
