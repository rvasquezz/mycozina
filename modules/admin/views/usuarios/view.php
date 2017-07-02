<?php

use app\modules\admin\models\Persona;
use app\modules\bienes\models\BienesSede;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SeguridadUsuarios */

$this->title = $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seguridad Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguridad-usuarios-view">

    <h1><?= Html::encode('Codigo del usuario:'.$this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_usuario',
             [
              'attribute' => 'nombres',
              'value' =>  Persona::findOne($model->id_persona)->nombres.' '. Persona::findOne($model->id_persona)->apellidos,
              'label'=>'Nombres Y Apellidos'
            ],

            [
              'attribute' => 'fnacimiento',
              'value' =>  Persona::findOne($model->id_persona)->fnacimiento,
              'label'=>'Fecha de Nacimiento'
            ],

             [
              'attribute' => 'login',
              'label'=>'Login(Usuario)'
            ],
            'password',
        ],
    ]) ?>

</div>
