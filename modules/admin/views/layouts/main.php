<?php

use yii\helpers\Html;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <!--
                <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>-->

        <!-- Bootstrap core CSS -->
        <link href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/fonts/font-awesome-4/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.gritter/css/jquery.gritter.css" />

        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.nanoscroller/nanoscroller.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.easypiechart/jquery.easy-pie-chart.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap.switch/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.select2/select2.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap.slider/css/slider.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.niftymodals/css/component.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/intro.js/introjs.css" />
        <!-- Custom styles for this template -->
        <link href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/css/style.css" rel="stylesheet" />
        <link href="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/css/override.css" rel="stylesheet" />


        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/js/funciones.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.gritter/js/jquery.gritter.js"></script>

        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/behaviour/general.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.ui/jquery-ui.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.easypiechart/jquery.easy-pie-chart.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.nestable/jquery.nestable.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap.switch/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.select2/select2.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/skycons/skycons.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap.slider/js/bootstrap-slider.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/intro.js/intro.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.blockui/jquery.blockUI.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript">
            $(document).ready(function() {
                //initialize the javascript
                App.init();
            });
        </script>
        <script src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/js/bootstrap/dist/js/bootstrap.min.js"></script>

    </head>
    <body>

        <?php $this->beginBody() ?>

        <!-- Fixed navbar -->
        <div id="head-nav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-collapse collapse">
                    <?php
//                    echo Nav::widget([
//                        'items' => [
//                            '<li class="active">' . Html::a("Inicio", ['index']) . '</li>',
//                            [
//                                'label' => 'Home', 'url' => ['/site/index'],
//                                'itemOptions' => [ 'class' => 'hola']
//                            ],
//                        ],
//                        'options' => [
//                            'class' => 'nav navbar-nav',
//                        ],
//                    ]);
                    ?>

                    <ul class="nav navbar-nav navbar-right user-nav">
                        <li class="button dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><span class="bubble">1</span></a>
                            <ul class="dropdown-menu messages">
                                <li>
                                    <div class="nano nscroller">
                                        <div class="content">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <span class="date pull-right">12 Dic.</span> <span class="name">Bienvenido</span> a la nueva Intranet de la Gobernación Del Estado Anzoátegui!
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="foot"><li><a href="#">Ver Todos Los Mensajes</a></li></ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown profile_menu">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="avatar" alt="Avatar" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/images/user-icon.png" />
                                    <span>Invitado</span><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="md-trigger" data-modal="colored-danger" href="#">Iniciar Sesion</a></li>

                                </ul>
                            <?php else: ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="avatar" alt="Avatar" src="<?= isset(Yii::$app->user->avatar) ? Yii::$app->user->avatar : Yii::$app->getUrlManager()->getBaseUrl() . "/theme/images/user-icon.png" ?>" />
                                    <span><?= Yii::$app->user->identity->persona0->nombres . " " . Yii::$app->user->identity->persona0->nombres ?></span><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Mi Cuenta</a></li>
                                    <li><a href="#">Perfil</a></li>
                                    <li><a href="#">Mensajes</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?= yii\helpers\Url::toRoute("site/logout") ?>">Salir</a></li>
                                </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div><!--/.nav-collapse animate-collapse -->
            </div>
        </div>

        <!-- sidebar  -->
        <div id="cl-wrapper" class="fixed-menu">
            <div class="cl-sidebar">
                <div class="cl-toggle"><i class="fa fa-bars"></i></div>
                <div class="cl-navblock">
                    <div class="menu-space">
                        <div style="right: -15px;" tabindex="0" class="content">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <div class="side-user">
                                    <div class="avatar"><img src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/images/user-icon.png" alt="Avatar" /></div>
                                    <div class="info">
                                        <a href="#">Invitado</a>
                                        <img src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/images/state_online.png" alt="Status" /> <span>Online</span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="side-user">
                                    <div class="avatar"><img src="<?= isset(Yii::$app->user->avatar) ? Yii::$app->user->avatar : Yii::$app->getUrlManager()->getBaseUrl() . "/theme/images/user-icon.png" ?>" alt="Avatar" /></div>
                                    <div class="info">
                                        <a href="#"><?= Yii::$app->user->identity->persona0->nombres . " " . Yii::$app->user->identity->persona0->apellidos ?></a>
                                        <img src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/images/state_online.png" alt="Status" /> <span>Online</span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            echo \app\components\AitMenu::widget([
                                'options' => ['class' => 'cl-vnavigation'],
                                'encodeLabels' => false, //allows you to use html in labels
                                'activateParents' => true,
                                'items' => [
                                    ['label' => 'Seguridad', 'url' => '#',
                                        'icon' => 'phone',
                                        'items' => [
                                            ['label' => 'Usuarios', 'url' => ['//usuario/']],
                                            ['label' => 'Grupos', 'url' => ['/admin/grupo']],
                                            ['label' => 'Modulos', 'url' => ['/admin/modulo']],
                                        ]
                                    ],
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="pane"><div style="height: 40px; top: 0px;" class="slider"></div></div></div>
                    <div class="text-right collapse-button" style="padding:7px 9px;">
                        <input class="form-control search" placeholder="Buscar..." type="text">
                        <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                    </div>
                </div></div>

            <div class="container-fluid" id="pcont">
                <div class="cl-mcont" id="contenido">
                    <h1></h1>
                    <?= $content ?>
                </div>
            </div>
        </div>
        <?php if (Yii::$app->user->isGuest): ?>
            <?=
            $this->render('//usuario/_login', [
                'model' => new app\models\LoginForm(),
            ])
            ?>
<?php endif; ?>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
