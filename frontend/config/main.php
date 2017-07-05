<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        //login facebook/gmail
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                'class' => 'yii\authclient\clients\Facebook',
                'clientId' => '143800462862668',
                'clientSecret' => '93c89c021b02027a8afde47f6c14a5d1',
                'attributeNames' => ['id','name', 'email', 'first_name', 'last_name','birthday','gender','picture'],
                ],
                'google' => [
                      'class'        => 'yii\authclient\clients\Google',
                      'clientId'     => '650351552201-h6tk4lk0ocuhi6iuhc7tuvij8rtjlu1t.apps.googleusercontent.com',
                      'clientSecret' => 'd_oKxUJ-hNJ9MBCe5dM9_z5B',
                      // 'returnUrl'=>'https://test.com/site/auth?authclient=google',
                ],
  
            ],
         ],

        //template
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/plantilla',
                ],
                'basePath' => '@web/../themes/plantilla',
                'baseUrl' => '@web/../themes/plantilla',
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
    'aliases' => [
        '@modelsPath' => '@app/models',
        '@themes' => '@app/themes'
    ],
];
