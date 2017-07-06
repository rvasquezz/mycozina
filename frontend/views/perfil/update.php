<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Perfil */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Perfil',
]) . $model->id_perfil;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perfils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_perfil, 'url' => ['view', 'id' => $model->id_perfil]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="perfil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
