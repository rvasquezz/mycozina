<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\admin\models\Grupo;
use backend\modules\admin\models\AccionGrupo;
use backend\modules\admin\models\Modulo;
use backend\modules\admin\models\Acciones;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\admin\models\GrupoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Grupos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Registrar Grupo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id_grupo',
            'nombre',
            'descripcion',
            [
                'header' => 'Permisos',
                'value' => function($data) {
                    $data instanceof Grupo;
                    $permisos = [];
                    if ($data->seguridadAccionGrupos != null && count($data->seguridadAccionGrupos) > 0)
                    {
                        foreach ($data->seguridadAccionGrupos as $accionGrupo)
                        {
                            $accionGrupo instanceof AccionGrupo;
                            $aux = "Modulo: ".strtoupper($accionGrupo->idAccion->idControlador->idModulo->descripcion)." - Controlador: ".str_ireplace("controller", "", $accionGrupo->idAccion->idControlador->descripcion);
                            $permisos[$aux][] = Yii::t('app',  $accionGrupo->idAccion->descripcion);
                            //$return = $return . "<li>" . Html::a($accionGrupo->descripcion, ['/admin/acciones/view', 'id' => $accionGrupo->id_controlador]) . "</li>";
                        }
                    }
                    return Html::listBox("Permisos", NULL, $permisos, []);
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Acciones' ],
        ],
    ]);
    ?>

</div>
