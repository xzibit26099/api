<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => Yii::getAlias('@api_v1'),
            'class' => 'api\modules\v1\Module',
        ],
        'v2' => [
            'basePath' => Yii::getAlias('@api_v2'),
            'class' => 'api\modules\v2\Module',
        ],
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'formatters' => [
                'class' => 'yii\web\JsonResponseFormatter',
                'prettyPrint' => YII_DEBUG,
                'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'v1/login-by-username' => 'v1/site/login-by-username',
                'v1/login-by-email' => 'v1/site/login-by-email',
                'v1/address/create' => 'v1/address/create',
                'v1/address/update' => 'v1/address/update',
                'v1/address/delete' => 'v1/address/delete',

                'v2/login-by-username' => 'v2/site/login-by-username',
                'v2/login-by-email' => 'v2/site/login-by-email',
                'v2/graphql' => 'v2/graphql/index',
            ],
        ],
    ],
    'params' => $params,
];
