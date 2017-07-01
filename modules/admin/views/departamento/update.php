<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departamento */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Departamento',
]) . $model->id_direccion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departamentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_direccion, 'url' => ['view', 'id' => $model->id_direccion]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="departamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
