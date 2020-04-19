<?php

namespace api\modules\v2\schema;

use common\models\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'username' => [
                        'type' => Type::string(),
                    ],
                    'email' => [
                        'type' => Type::string(),
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'args' => [
                            'format' => Type::string(),
                        ],
                        'resolve' => function(User $user, $args) {
                            if (isset($args['format'])) {
                                return date($args['format'], strtotime($user->created_at));
                            }

                            return $user->created_at;
                        },
                    ],
                    'status' => [
                        'type' => Type::int(),
                    ],

                    'addresses' => [
                        'type' => Type::listOf(Types::address()),
                        'resolve' => function(User $user) {
                            return $user->addresses;
                        },
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
