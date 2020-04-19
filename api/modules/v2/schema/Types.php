<?php

namespace api\modules\v2\schema;

class Types
{
    private static $query;
    private static $user;
    private static $address;

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function user()
    {
        return self::$user ?: (self::$user = new UserType());
    }

    public static function address()
    {
        return self::$address ?: (self::$address = new AddressType());
    }
}