<?php

use app\modules\admin\models\Acciones;
use app\modules\admin\models\Modulo;
use yii\grid\GridView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ControladorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Controladores');
$this->params['breadcrumbs'][] = $this->title;
$modulo= new Modulo();
?>
<div class="controlador-index">

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

            'id_controlador',
       
            'descripcion',

            [
                'attribute' => 'id_modulo',
                'value' => function($modulo){
                $modul = Modulo::findOne($modulo->id_modulo);
                return $modul->descripcion;
                },
                'label'=>'Modulo',
                'filter' => Html::activeTextInput($searchModel, 'descripcion_modulo', ['class' => 'form-control']),

            ],

            [
                'filter' => '<input class="form-control" name="controlador" type="text">',
                'attribute' => 'acciones',
                'value' => function($data){
                $return = "<ol>";
                $accion= Acciones::find()->where(['id_controlador'=>$data->id_controlador])->all();

                foreach ($accion as $accions)
                {
                $return = $return . "<li>" . Html::a($accions->descripcion, ['/admin/acciones/view', 'id_accion' => $accions->id_accion,'id_controlador' => $accions->id_controlador]) . "</li>";
                }

                return $return . "</ol>";
                },
                'format' => 'raw',
                'filter'=>'',

                'label'=>'Acciones'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
