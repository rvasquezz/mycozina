<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Grupo */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_grupo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_grupo], [
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
            'id_grupo',
            'nombre',
            'descripcion',
        ],
    ]) ?>
    
    <div class="row">
        <div class="col-lg-5">
            <?= Yii::t('app', 'Avaliable') ?>:
            <input id="search-available"><br>
            <div id="list-available-div">
                <select id="list-available" multiple size="20" style="width: 100%">
                </select>
            </div>
        </div>
        <div class="col-lg-1">
            <br><br>
            <a href="#" id="btn-assign" class="btn btn-success">&gt;&gt;</a><br>
            <a href="#" id="btn-revoke" class="btn btn-danger">&lt;&lt;</a>
            <a href="#" id="btn-refresh" class="btn btn-info"><i class="fa fa-refresh"></i></a>
        </div>
        <div class="col-lg-5">
            <?= Yii::t('app', 'Assigned') ?>:
            <input id="search-assigned"><br>
            <div id="list-assigned-div">
                <select id="list-assigned" multiple size="20" style="width: 100%">
                </select>
            </div>
        </div>
    </div>    

    <script type="text/javascript">
        
        $(document).ready(function(){
            actualizarPermisos();
            $('#btn-assign').click(function () {
                asignarPermisos(<?= $model->id_grupo ?>, $("#list-available option:selected").val(), 1);
                return false;
            });
            $('#btn-revoke').click(function () {
                asignarPermisos(<?= $model->id_grupo ?>, $("#list-assigned option:selected").val(), -1);
                return false;
            });
            $('#btn-refresh').click(function () {
                actualizarPermisos();
                return false;
            });
        });
        
    function asignarPermisos(id, accion, tipo)
    {
        $.ajax({
            sync: false,
            type: 'POST',
            cache: false,
            url: '<?= yii\helpers\Url::to(['/admin/grupo/asignar-permisos']) ?>',
            data: {
                id: id,
                accion : accion,
                tipo : tipo
            },
            beforeSend: function (xhr)
            {
                $('#contenido').block({css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }});

            },
            error: function (error) {
                //error(error);
                $('#contenido').unblock();
            },
            success: function (response) {
                $('#contenido').unblock();
                if( response.success )
                {
                    actualizarPermisos();
                }
                else
                {
                    alert(response.message);
                }
            }
        });
    }
        
    function actualizarPermisos()
    {
        $.ajax({
            sync: false,
            type: 'POST',
            cache: false,
            url: '<?= yii\helpers\Url::to(['/admin/grupo/buscar-permisos']) ?>',
            data: {
                id: <?= $model->id_grupo ?>
            },
            beforeSend: function (xhr)
            {
                $('#contenido').block({css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }});

            },
            error: function (error) {
                //error(error);
                $('#contenido').unblock();
            },
            success: function (response) {
                $('#contenido').unblock();
                //response = JSON.parse(response);
                if( response.success )
                {
                    $("#list-available-div").html( response.available );
                    $("#list-assigned-div").html( response.assigned );
                }
                else
                {
                    alert(response.message);
                }
            }
        });
    }
    </script>
  
</div>
