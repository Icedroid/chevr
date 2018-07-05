<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-08-30 18:10
 */
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\helpers\Url;
use yii\rest\CreateAction;
use yii\rest\IndexAction;
use yii\web\Response;
use api\modules\v1\models\CarFeedback;

class DefaultController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;//默认浏览器打开返回json
        return $behaviors;
    }

    public function actionIndex()
    {
        return [
            "api service"
        ];
    }

   /** 
    * 用户登录接口
    *
    * @SWG\Post(path="/login",
    *     tags={"api"},
    *     summary="用户登录",
    *     description="返回 access_token",
    *     @SWG\Parameter(
    *        in = "formData",
    *        name = "request body",
    *        description = "用户信息",
    *        required = true,
    *        type = "string",
    *        @SWG\Schema(ref="#/definitions/Error"),
    *     ),
    *     @SWG\Response(
    *         response = 200,
    *         description = " success"
    *     )
    * )
    */
    public function actionLogin()
    {

        return [
            "login to do"
        ];
    }

    /**
     * 启动获取配置信息接口
     *
     * @SWG\Get(path="/config",
     *     tags={"api"},
     *     summary="获取配置信息",
     *     description="应用所有在服务端保存的信息都由此接口返回",
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
     *         description = "success"
     *     )
     * )
     * @return void
     */
    public function actionConfig()
    {
        $config = Yii::$app->params['phoneConfig'];
        $startup = [];
        if(isset($config['startup'])){
            foreach($config['startup'] as $img){
                $startup[] = Yii::$app->request->hostInfo.DIRECTORY_SEPARATOR.ltrim($img, DIRECTORY_SEPARATOR);
            }
           $config['startup'] = $startup; 
        }
        return $config;
    }

    /**
     * 用户反馈接口 
     *  @SWG\Post(path="/feedback",
    *     tags={"api"},
    *     summary="用户反馈接口",
    *     description="请使用表单形式提交数据",
    *     produces={"application/json"},
    *     @SWG\Parameter(
    *        in = "query",
    *        name = "access-token",
    *        description = "access token",
    *        required = false,
    *        type = "string"
    *     ),
    *     @SWG\Parameter(
    *        in = "formData",
    *        name = "content",
    *        description = "反馈内容",
    *        required = true,
    *        type = "string"
    *     ),
    *     @SWG\Parameter(
    *        in = "formData",
    *        name = "image",
    *        description = "图片url数组",
    *        required = true,
    *        type = "string"
    *     ),
    *     @SWG\Response(
    *         response = 200,
    *         description = " success"
    *     ),
    *     @SWG\Response(
    *         response = 401,
    *         description = "需要重新登陆",
    *         @SWG\Schema(ref="#/definitions/Error")
    *     )
    * )
     * 
     * @return void
     */
    public function actionFeedback()
    {
        return (new CreateAction($this->action->id, $this->id, [
            'modelClass' => 'api\modules\v1\models\CarFeedback'
        ]))->run();

//        /* @var $model \yii\db\ActiveRecord */
//        $model = new CarFeedback([
//            'scenario' => ['content', 'image'],
//        ]);
//
//        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
//        if ($model->save()) {
////            $response = Yii::$app->getResponse();
////            $response->setStatusCode(201);
////            $id = implode(',', array_values($model->getPrimaryKey(true)));
////            $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
//        }
//
//        return [
//            "msg"=>"ok",
//        ];
    }

}
