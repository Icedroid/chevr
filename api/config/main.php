<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'Chevr API',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'user' => [
            'class' => yii\web\User::className(),
            'identityClass' => api\modules\v1\models\User::className(),
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'log' => [//此项具体详细配置，请访问http://wiki.feehi.com/index.php?title=Yii2_log
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::className(),//当触发levels配置的错误级别时，保存到日志文件
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'cache' => [
            'class' => yii\caching\DummyCache::className(),
            'keyPrefix' => 'api',       // 唯一键前缀
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'v1/default/index',
                'v1/login' => 'v1/default/login',
                'v1/config' => 'v1/default/config',
                'v1/feedback' => 'v1/default/feedback',
                [
                    'class' => yii\rest\UrlRule::className(),
                    'controller' => ['v1/car','v1/user', 'v1/article'],
                ],
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => yii\web\JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                    // ...
                ],
            ],
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null) {
                    $response->data = [
                        'code' => $response->isSuccessful ? 1 : 0,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
        ],
    ],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'params' => $params,
];
