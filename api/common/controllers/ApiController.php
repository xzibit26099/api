<?php

namespace api\common\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'authMethods' => [
                    [
                        'class' => HttpBasicAuth::class,
                        'auth' => function ($username, $password) {
                            $user = User::findOne([
                                'username' => $username,
                                'status' => User::STATUS_ACTIVE
                            ]);

                            if (empty($user)) {
                                return null;
                            }

                            if (!$user->validatePassword($password)) {
                                return null;
                            }

                            return $user;
                        }
                    ],
                    [
                        'class' => HttpBearerAuth::class
                    ]
                ]
            ],
            'corsFilter'  => [
                'class' => Cors::class,
                'cors'  => [
                    'Origin'                           => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['post', 'get'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,
                ],
            ],
        ]);
    }

    /**
     * @return string[]
     */
    public static function allowedDomains()
    {
        return [
            'http://www.test.local',
            'http://www.api.test.local',
        ];
    }
}
