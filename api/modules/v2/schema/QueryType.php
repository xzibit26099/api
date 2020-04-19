<?php

namespace api\modules\v2\schema;

use common\models\address\Address;
use common\models\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'user' => [
                        'type' => Types::user(),
                        'args' => [
                            'id' => Type::nonNull(Type::int()),
                        ],
                        'resolve' => function($root, $args) {
                            return User::find()->where(['id' => $args['id']])->one();
                        }
                    ],

                    'addresses' => [
                        'type' => Type::listOf(Types::address()),
                        'args' => [
                            'zip' => Type::string(),
                            'street' => Type::string(),
                        ],
                        'resolve' => function($root, $args) {
                            $query = Address::find();

                            if (!empty($args)) {
                                $query->where($args);
                            }

                            return $query->all();
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}