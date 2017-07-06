<?php

namespace common\components;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;


class AitController extends Controller
{
    public function beforeAction($action)
    {
        $accion = str_ireplace("action", "", $action->actionMethod);
        try
        {
                if( !User::hasAccess( $this->module->id, $this->id, $accion ) )
                {
                    throw new ForbiddenHttpException("DISCULPE USTED NO POSEE LOS PERMISOS NECESARIOS PARA ACCEDER A ESTA SECCIÓN DEL SISTEMA");
                }
        }
        catch (Exception $ex)
        {
            $this->redirect(['/site/index']);
        }
        return true;
    }
}


?>
