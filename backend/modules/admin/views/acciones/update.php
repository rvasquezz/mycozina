<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Acciones */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Acciones',
]) . ' ' . $model->id_accion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_accion, 'url' => ['view', 'id_accion' => $model->id_accion, 'id_controlador' => $model->id_controlador]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
