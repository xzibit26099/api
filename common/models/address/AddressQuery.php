<?php

namespace common\models\address;

/**
 * This is the ActiveQuery class for [[Address]].
 *
 * @see Address
 */
class AddressQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Address[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Address|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
