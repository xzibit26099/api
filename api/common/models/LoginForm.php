<?php

namespace api\common\models;

use common\models\User;
use yii\base\Model;

class LoginForm extends Model
{
    const SCENARIO_LOGIN_BY_EMAIL = 'email';
    const SCENARIO_LOGIN_BY_USERNAME = 'username';

    public $email;
    public $username;
    public $password;

    private $_user;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'on' => self::SCENARIO_LOGIN_BY_USERNAME],
            [['email', 'password'], 'required', 'on' => self::SCENARIO_LOGIN_BY_EMAIL],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            if ($this->scenario == self::SCENARIO_LOGIN_BY_USERNAME) {
                $this->_user = User::findByUsername($this->username);
            }

            if ($this->scenario == self::SCENARIO_LOGIN_BY_EMAIL) {
                $this->_user = User::findByEmail($this->email);
            }
        }

        return $this->_user;
    }
}
