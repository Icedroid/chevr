<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-08-30 18:10
 */

namespace api\modules\v1\controllers;

use yii\web\Response;
use yii\data\ActiveDataProvider;

class CarController extends \yii\rest\ActiveController
{
    public $modelClass = 'api\modules\v1\models\CarInfo';
//    public $serializer = [
//        'class' => 'yii\rest\Serializer',
//        'collectionEnvelope' => 'items',
//    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;//默认浏览器打开返回json
        return $behaviors;
    }

    /**
     * @SWG\Get(path="/cars",
     *     tags={"api"},
     *     summary="获取车型列表",
     *     description="返回一个包含所有车型信息数据",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "access-token",
     *        description = "access token",
     *        required = false,
     *        type = "string"
     *     ),
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = "success",
     *         @SWG\Schema(ref="#/definitions/Car"),
     *     )
     * )
     */
    public function actions()
    {
        $actions = parent::actions();

        // 禁用"delete" 和 "create" 动作
        unset($actions['delete'], $actions['create'], $actions['update']);

        // 使用"prepareDataProvider()"方法自定义数据provider
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        /*$actions['index']['dataFilter'] = [
            'class' => 'yii\data\ActiveDataFilter',
            'searchModel' => function () {
                return (new \yii\base\DynamicModel(['id' => null, 'name' => null, 'status' => null]))
                    ->addRule('id', 'integer')
                    ->addRule('status', 'integer')
                    ->addRule('name', 'trim')
                    ->addRule('name', 'string');
            },
            'filter'=>['status' => ($this->modelClass)::STATUS_ACTIVE],

        ];*/

        return $actions;
    }

    public function prepareDataProvider()
    {
        $where = ['status' => ($this->modelClass)::STATUS_ACTIVE];
        $query = ($this->modelClass)::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sort' => SORT_ASC,
                    'id' => SORT_DESC,
                ]
            ]
        ]);
        return $dataProvider;
    }
}
