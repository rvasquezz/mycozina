<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departamento */

$this->title = $model->id_direccion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departamentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Volver'), ['index'], ['class' => 'btn btn-danger']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_direccion',
            'nombre',
            'encargado',
            'sufijo',
        ],
    ]) ?>

</div>
