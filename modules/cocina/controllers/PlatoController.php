<?php

namespace app\modules\cocina\controllers;

class PlatoController extends \app\components\AitController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
