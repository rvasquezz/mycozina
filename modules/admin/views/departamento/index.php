<?php

use kartik\widgets\AlertBlock;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\DepartamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
echo AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => AlertBlock::TYPE_ALERT,
    'delay' => 7000,
]);
$this->title = Yii::t('app', 'Departamentos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Registrar'), ['create'], ['class' => 'btn btn-success']) ?>
       
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'nombre',
            'encargado',
            'sufijo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
