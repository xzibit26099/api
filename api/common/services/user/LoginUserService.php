<?php

namespace api\common\services\user;

use common\models\Token;
use common\models\User;
use Yii;

class LoginUserService
{
    private $_user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    /**
     * @return Token|null
     */
    public function createToken()
    {
        $token = new Token();
        $token->user_id = $this->_user->id;
        $token->expired_at = (new \DateTime())->modify('+ ' . Yii::$app->params['tokenExpiredAt'] . ' sec')->format('Y-m-d H:i:s');
        $token->token = \Yii::$app->security->generateRandomString();

        if ($token->save()) {
            return $token;
        }

        return null;
    }
}
