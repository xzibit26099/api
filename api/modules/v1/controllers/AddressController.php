<?php

namespace api\modules\v1\controllers;

use api\common\models\address\AddressForm;
use api\common\services\address\AddressService;
use api\common\controllers\ApiController;
use common\models\address\Address;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

class AddressController extends ApiController
{
    public $modelClass = 'common\models\address\Address';

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * @return array
     */
    public function verbs()
    {
        return [
            'create' => ['post'],
            'update' => ['post'],
            'delete' => ['post'],
        ];
    }

    /**
     * @return AddressForm|bool|Address
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        $modelForm = new AddressForm();
        $modelForm->scenario = AddressForm::SCENARIO_CREATE;
        $modelForm->load(Yii::$app->getRequest()->getBodyParams(), '');
        $modelForm->user_id = Yii::$app->user->id;

        if (!$modelForm->validate()) {
            return $modelForm;
        }

        $service = new AddressService(new Address());
        if (!($model = $service->create($modelForm))) {
            throw new ServerErrorHttpException('Failed to create Address.');
        }

        Yii::$app->getResponse()->setStatusCode(201);

        return $model;
    }

    /**
     * @param $id
     * @return AddressForm|bool
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate($id)
    {
        $modelForm = new AddressForm();
        $modelForm->scenario = AddressForm::SCENARIO_UPDATE;
        $modelForm->load(Yii::$app->getRequest()->getBodyParams(), '');
        $modelForm->id = $id;
        $modelForm->user_id = Yii::$app->user->id;

        if (!$modelForm->validate()) {
            return $modelForm;
        }

        $model = Address::findOne($id);
        $service = new AddressService($model);
        if (!($model = $service->update($modelForm))) {
            throw new ServerErrorHttpException('Failed to update Address.');
        }

        Yii::$app->getResponse()->setStatusCode(202);

        return $model;
    }

    /**
     * @param $id
     * @return AddressForm|bool
     * @throws ServerErrorHttpException
     */
    public function actionDelete($id)
    {
        $modelForm = new AddressForm();
        $modelForm->id = $id;

        if (!$modelForm->validate()) {
            return $modelForm;
        }

        $model = Address::findOne($id);
        $service = new AddressService($model);
        if (!$service->delete()) {
            throw new ServerErrorHttpException('Failed to delete Address.');
        }

        Yii::$app->getResponse()->setStatusCode(202);

        return true;
    }

    /**
     * @param string $action
     * @param Address $model
     * @param array $params
     * @throws ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete'])) {
            if (Yii::$app->user->id != $model->user_id) {
                throw  new ForbiddenHttpException('Forbidden.');
            }
        }
    }
}
