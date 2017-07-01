<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ModuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modulos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modulo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Recrear Modulos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_modulo',
            [
                'attribute' => 'descripcion',
                'format' => 'raw',
            ],
            [
                'filter' => '<input class="form-control" name="controlador" type="text">',
                'header' => 'Controladores',
                'value' => function($data) {
                    $return = "<ul>";
                    if ($data->seguridadControladors != null && count($data->seguridadControladors) > 0)
                    {
                        foreach ($data->seguridadControladors as $controlador)
                        {
                            $return = $return . "<li>" . Html::a($controlador->descripcion, ['/admin/controlador/view', 'id' => $controlador->id_controlador]) . "</li>";
                        }
                    }
                    return $return . "</ul>";
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
