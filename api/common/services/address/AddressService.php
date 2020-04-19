<?php

namespace api\common\services\address;

use api\common\models\address\AddressForm;
use common\helpers\Log;
use common\models\address\Address;
use Yii;

class AddressService
{
    private $_model;

    /**
     * @param Address $model
     */
    public function __construct(Address $model)
    {
        $this->_model = $model;
    }

    /**
     * @param AddressForm $modelForm
     * @return boolean|Address
     */
    public function create(AddressForm $modelForm)
    {
        $model = $this->_model;
        $model->setAttributes($modelForm->getAttributes());
        $model->updated_at = (new \DateTime())->format('Y-m-d H:i:s');

        if (!$model->save()) {
            Log::modelError('Failed to save when create Address', $modelForm, 'AddressService.create');
            return false;
        }

        return $model;
    }

    /**
     * @param AddressForm $modelForm
     * @return boolean
     */
    public function update(AddressForm $modelForm)
    {
        $model = $this->_model;
        $model->setAttributes($modelForm->getAttributes());
        $model->updated_at = (new \DateTime())->format('Y-m-d H:i:s');

        if (!$model->save()) {
            Log::modelError('Failed to save when update Address', $modelForm, 'AddressService.update');
            return false;
        }

        return false;
    }

    /**
     * @return boolean
     */
    public function delete()
    {
        $model = $this->_model;

        if (!$model->delete()) {
            Log::modelError('Failed to delete Address', $model, 'AddressService.delete');
            return false;
        }

        return false;
    }
}
