<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UsuarioGrupo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-grupo-form">

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
                asignarPermisos(<?= $model->id_usuario ?>, $("#list-available option:selected").val(), 1);
                return false;
            });
            $('#btn-revoke').click(function () {
                asignarPermisos(<?= $model->id_usuario ?>, $("#list-assigned option:selected").val(), -1);
                return false;
            });
            $('#btn-refresh').click(function () {
                actualizarPermisos();
                return false;
            });
        });
        
    function asignarPermisos(id, grupo, tipo)
    {
        $.ajax({
            sync: false,
            type: 'POST',
            cache: false,
            url: '<?= yii\helpers\Url::to(['/admin/permisos-usuario/asignar-permisos']) ?>',
            data: {
                id: id,
                grupo : grupo,
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
            url: '<?= yii\helpers\Url::to(['/admin/permisos-usuario/buscar-permisos']) ?>',
            data: {
                id: <?= $model->id_usuario ?>
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

    <div class="form-group">
        <?= Html::button("Volver", ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

</div>
