<?php

namespace api\common\controllers;

use api\common\models\LoginForm;
use api\common\services\user\LoginUserService;
use common\models\Token;
use Yii;
use yii\rest\Controller;

class SiteController extends Controller
{
    /**
     * @return array|\string[][]
     */
    protected function verbs()
    {
        return [
            'login-by-email' => ['post'],
            'login-by-username' => ['post'],
        ];
    }

    /**
     * @return array|Token
     */
    public function actionLoginByEmail()
    {
        $modelForm = new LoginForm();
        $modelForm->scenario = LoginForm::SCENARIO_LOGIN_BY_EMAIL;
        $modelForm->load(Yii::$app->request->bodyParams, '');

        if (!$modelForm->validate()) {
            return $modelForm->firstErrors;
        }

        $user = $modelForm->getUser();
        $service = new LoginUserService($user);

        return $service->createToken();
    }

    public function actionLoginByUsername()
    {
        $modelForm = new LoginForm();
        $modelForm->scenario = LoginForm::SCENARIO_LOGIN_BY_USERNAME;
        $modelForm->load(Yii::$app->request->bodyParams, '');

        if (!$modelForm->validate()) {
            return $modelForm->firstErrors;
        }

        $user = $modelForm->getUser();
        $service = new LoginUserService($user);

        return $service->createToken();
    }
}
