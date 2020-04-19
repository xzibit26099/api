<?php

namespace api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AddressType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'user' => [
                        'type' => Types::user(),
                    ],
                    'street' => [
                        'type' => Type::string(),
                    ],
                    'zip' => [
                        'type' => Type::string(),
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}