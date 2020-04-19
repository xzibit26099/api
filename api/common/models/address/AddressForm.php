<?php

namespace api\common\models\address;

use common\models\address\Address;
use common\models\User;
use yii\base\Model;

class AddressForm extends Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DELETE = 'delete';

    public $id;
    public $street;
    public $zip;
    public $user_id;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['street', 'zip'], 'string', 'max' => 100],
            [['street'], 'string', 'max' => 100],
            [['zip'], 'string', 'min' => 6, 'max' => 6],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::class, 'targetAttribute' => ['id' => 'id'], 'on' => self::SCENARIO_UPDATE],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['street', 'zip', 'user_id'],
            self::SCENARIO_UPDATE => ['id', 'street', 'zip', 'user_id'],
            self::SCENARIO_DELETE => ['id'],
        ];
    }
}
