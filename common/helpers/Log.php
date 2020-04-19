<?php
namespace common\helpers;

use yii\base\Model;
use Yii;

class Log
{
    /**
     * @param string $message
     * @param Model $model
     * @param string $category
     */
    public static function modelError(string $message, Model $model, string $category = 'application')
    {
        if ($model->hasErrors()) {
            $message .= ': ' . json_encode([
                'firstErrors' => $model->firstErrors,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        Yii::error($message, $category);
    }
}
