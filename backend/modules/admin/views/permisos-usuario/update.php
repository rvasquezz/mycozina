<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UsuarioGrupo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Permisos Usuario',
]) . ' ' . $model->login;
$this->params['breadcrumbs'][] = [
    'label' => 'Administracion',
    'url' => ['/admin/'],
];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuario Grupos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'login' => $model->login, 'id_usuario' => $model->id_usuario]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="usuario-grupo-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
