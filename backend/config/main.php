<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'es',
    'modules' => [        
        'admin' => [
                'class' => 'backend\modules\admin\Admin',
            ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                'class' => 'yii\authclient\clients\Facebook',
                // 'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                'clientId' => '143800462862668',
                'clientSecret' => '93c89c021b02027a8afde47f6c14a5d1',
                //nombre completo, correo, primer nombre, segundo nombre, fecha de nacimiento, sexo, foto de perfil
                // 'attributeNames' => ['name', 'email', 'first_name', 'last_name',''],
                'attributeNames' => ['id','name', 'email', 'first_name', 'last_name','birthday','gender','picture'],
                ],
                // 'google' => [
                //     'class' => 'yii\authclient\clients\GoogleOpenId'
                // ],
  
            ],
         ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'jasper' => [
            'class' => 'chrmorandi\jasper\Jasper',
            'db' => [
                'host' => 'localhost',
                // 'port' => 5432,    
                'driver' => 'mysql',
                'dbname' => 'mycocina',
                'username' => 'root'
            ]
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'db' => require(__DIR__ . '/../../config/db.php'),
        'urlManager' => [
	    'class'=>'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
    'aliases' => [
        '@modelsPath' => '@app/models',
        '@admin' => '@app/modules/admin'

    ],
];
