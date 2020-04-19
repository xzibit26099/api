<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $expired_at
 * @property string $token
 */
class Token extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%token}}';
    }

    /**
     * @return array|string[]
     */
    public function fields()
    {
        return [
            'token' => 'token',
            'expired_at' => 'expired_at',
        ];
    }
}
