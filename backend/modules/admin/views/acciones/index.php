<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AccionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use app\modules\admin\models\Controlador;
$controlador= new Controlador();

$this->title = Yii::t('app', 'Acciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acciones-index">

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

            'id_accion',
            'descripcion',
            [
                'attribute' => 'id_controlador',
                'value' => function($controlador){
                $control = Controlador::findOne($controlador->id_controlador);
                return $control->descripcion;
                },

                'label'=>'Controlador',
                'filter' => Html::activeTextInput($searchModel, 'descripcion_controlador', ['class' => 'form-control']), 
            ],
           

            [
                'class' => 'yii\grid\ActionColumn',
                //iconos de acciones
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['view', ' id_accion' => $model->id_accion,'id_controlador'=>$model->id_controlador], [
                        'title' => Yii::t('app', 'Ver')

                        ]);
                    }, 
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['update', ' id_accion' => $model->id_accion,'id_controlador'=>$model->id_controlador], [
                        'title' => Yii::t('app', 'Actualizar')

                        ]);
                    }, 
           
                ] //fin de buttons
            ],
        ],
    ]); ?>

</div>
