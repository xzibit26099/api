<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        echo base64_encode("test:121212");
    }
}