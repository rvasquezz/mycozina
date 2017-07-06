<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Modulo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Modulo',
]) . ' ' . $model->id_modulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modulos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_modulo, 'url' => ['view', 'id' => $model->id_modulo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="modulo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
