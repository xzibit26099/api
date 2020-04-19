<?php

namespace api\modules\v2\controllers;

use api\common\controllers\ApiController;
use api\modules\v2\schema\Types;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class GraphqlController extends ApiController
{
    public $modelClass = '';

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
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
    protected function verbs()
    {
        return [
            'index' => ['post'],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [];
    }

    /**
     * @return array|\GraphQL\Executor\Promise\Promise
     */
    public function actionIndex()
    {
        $query = \Yii::$app->request->get('query', \Yii::$app->request->post('query'));
        $variables = \Yii::$app->request->get('variables', \Yii::$app->request->post('variables'));
        $operation = \Yii::$app->request->get('operation', \Yii::$app->request->post('operation', null));

        if (empty($query)) {
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variables = isset($input['variables']) ? $input['variables'] : [];
            $operation = isset($input['operation']) ? $input['operation'] : null;
        }

        if (!empty($variables) && !is_array($variables)) {
            try {
                $variables = Json::decode($variables);
            } catch (InvalidParamException $e) {
                $variables = null;
            }
        }

        $schema = new Schema([
            'query' => Types::query(),
        ]);

        $result = GraphQL::execute(
            $schema,
            $query,
            null,
            null,
            empty($variables) ? null : $variables,
            empty($operation) ? null : $operation
        );

        return $result;
    }
}