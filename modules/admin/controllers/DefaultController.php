<?php
namespace app\modules\admin\controllers;
use Yii;
use app\components\AitController;

class DefaultController extends AitController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
}
