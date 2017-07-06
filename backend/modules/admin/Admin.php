<?php

namespace backend\modules\admin;

use \Yii;

class Admin extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\admin\controllers';

    public function init()
    {
        parent::init();
        if( \Yii::$app->user->isGuest || !\Yii::$app->user->identity->hasAccess($this->id) )
        {
            \Yii::$app->getResponse()->redirect( \yii\helpers\Url::toRoute("/site/login" ) );
        }
        \Yii::$app->params['menuItems'] = [
            [
                'label' => 'Inicio', 'url' => \Yii::$app->homeUrl,
                'icon' => 'dashboard',
            ],

            //label de bienes
            [
                'label' => 'Orden', 'url' => ['/orden/'],
                'icon' => 'table',
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->hasAccess("solicitud"),
            ],

            [
                'label' => 'Administracion', 'url' => '#',
                'visible' => !\Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin(),
                'icon' => 'users',
                'items' => [
                    [
                        'label' => 'Seguridad', 'url' => ['/admin/'],
                        'items' => [
                            [
                                'label' => 'Permisos de Usuarios', 'url' => ['/admin/permisos-usuario']
                            ],
                            [
                                'label' => 'Grupos', 'url' => ['/admin/grupo']
                            ],
                                 [
                                'label' => 'Acciones', 'url' => ['/admin/acciones']
                            ],
                                 [
                                'label' => 'Controladores', 'url' => ['/admin/controlador']
                            ],
                            [
                                'label' => 'Modulos', 'url' => ['/admin/modulo']
                            ],
                            [
                                'label' => 'Usuarios', 'url' => ['/admin/usuarios']
                            ],
                        ],
                    ],
                ]
            ],
        ];
    }
}
