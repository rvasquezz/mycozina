<?php
use app\modules\admin\models\UsuarioGrupo;
use kartik\widgets\AlertBlock;
use kartik\widgets\Select2;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
echo AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => AlertBlock::TYPE_ALERT,
    'delay' => 7000,
]);

$this->title = Yii::t('app', 'Seguridad Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguridad-usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Registrar Usuarios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
          
          ['attribute'=>'nombres',
          'header'=>'<a href="#">Nombres</a>',
          'value'=>'persona0.nombres'
          ],
          ['attribute'=>'apellidos',
          'header'=>'<a href="#">Apellidos</a>',
          'value'=>'persona0.apellidos'
          ],
            'cedula',
             'login',

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}{update}',
            'header'=>'Ver/Actualizar',
            'buttons' => [
              'view' => function ($url, $model, $key) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
                    'id' => 'boton_crear',
                    'title' => Yii::t('app', 'Vista'),
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'data-url' => Url::to(['view', 'id' => $model->id_usuario]),
                    'data-pjax' => '0',
                   
                ]);
            }, ]//button
            ],

            ['class' => 'yii\grid\ActionColumn','template'=>'{desactivar}',
            'header'=>'Desactivar',
            'buttons' => [
              'desactivar' => function ($url, $model, $key) {
                return 
                UsuarioGrupo::find()->where(['id_usuario'=>$model->id_usuario])->one() ?
                Html::a('<span class="glyphicon glyphicon-remove"></span>','#', [
                    'id' => 'boton_desactivar',
                    'class'=>  'btn btn-danger' ,
                    'data-url' => Url::to(['delete', 'id' => $model->id_usuario]),
                    'title' => Yii::t('app', 'Desactivar'),
                   
                ])
                :  Html::a('Desactivado','#', [
                    'class'=>  'btn btn-warning' ,
                    'title' => Yii::t('app', 'no activo'),
              
                ]);

            }, ]//button
            ],
        ],
    ]); ?>
    <?php
    $this->registerJs(
        "$(document).on('click', '#boton_crear', (function() {
            $.get(
                $(this).data('url'),
                function (data) {
                    $('.modal-body').html(data);
                    $('#modal').modal();
                                 } 
                     );
                                                              }));"
    ); ?>

<?php
Modal::begin([
    'id' => 'modal',
    'header' => '<h4 class="modal-title">DATOS DE LA PERSONA</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
]);
 
echo "<div class='well'></div>";
 
Modal::end();
?>
</div>


     <?php
    $this->registerJs(
        "$(document).on('click', '#boton_desactivar', (function() {
            if(confirm('Desea desactivar el usuario?')==true)
            {
            $.get(
                $(this).data('url'),
                function (data) {
                                 } 
                     );
            }
                                                              }));"
    ); ?>

