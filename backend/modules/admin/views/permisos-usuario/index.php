<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Permisos de Usuario');
$this->params['breadcrumbs'][] = [
    'label' => 'Administracion',
    'url' => ['/admin/'],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-grupo-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'login',
            [
                'header' => 'Permisos',
                'attribute' => 'idGrupos',
                'format' => 'raw',
                'value' => function($data) {
                    $return = "<ul>";
                    if ($data->idGrupos != null && count($data->idGrupos) > 0) {
                        foreach ($data->idGrupos as $grupo) {
                            $return = $return . "<li>" . Html::a($grupo->nombre, ['/admin/grupo/view', 'id' => $grupo->id_grupo]) . "</li>";
                        }
                    }
                    return $return . "</ul>";
                },
            ],
//            [
//                'header' => 'Grupo',
//                'attribute' => 'id_grupo',
//                'value' => 'idGrupo.nombre',
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]);
    ?>

</div>
