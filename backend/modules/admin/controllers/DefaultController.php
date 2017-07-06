<?php
namespace backend\modules\admin\controllers;
use Yii;
use common\components\AitController;

class DefaultController extends AitController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
}
