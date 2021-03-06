<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AccionGrupo */

$this->title = $model->id_accion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accion Grupos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_accion' => $model->id_accion, 'id_controlador' => $model->id_controlador, 'id_grupo' => $model->id_grupo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_accion' => $model->id_accion, 'id_controlador' => $model->id_controlador, 'id_grupo' => $model->id_grupo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_accion',
            'id_controlador',
            'id_grupo',
        ],
    ]) ?>

</div>
