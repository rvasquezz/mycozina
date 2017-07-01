<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SeguridadUsuarios */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Seguridad Usuarios',
]) . ' ' . $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seguridad Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_usuario, 'url' => ['view', 'id' => $model->id_usuario]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="seguridad-usuarios-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'person'=>$person
    ]) ?>

</div>

<script>                      //enviar formulario personas
$('#validador').click(function(event) {
    // event.preventDefault();
   var login=$('#seguridadusuarios-login').val();
   var password=$('#seguridadusuarios-password').val();

   if(!login)
   {
        alert('Debe colocar un login');
        event.preventDefault();
   }
   if(!password)
   {
        alert('Debe colocar un password');
        event.preventDefault();
   }
   if(password.length<6)
   {
        alert('Debe colocar un password con mas de 6 dígitos');
        event.preventDefault();
   }
   
});

      $('#act_persona').show();
     $('#ocultar_usuario').show();
     $('#ocultar_cedula').show();
     
      $('#seguridadusuarios-cedula').attr('disabled', 'disabled');
      $('#persona-cedula').attr('disabled', 'disabled');
        $("#act_persona").click(function () {
          var sexo= $('input:radio[name="Persona[sexo]"]:checked').val();
      var correoo  =$("#persona-correoe").val();
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

           if ( !expr.test(correoo) ){
        alert("Error: La dirección de correo " + correoo + " es incorrecta.");
        return false;
                            }                 

            cedulap = $("#persona-cedula").val();
            nombrep = $("#persona-nombres").val();
            apellidop = $("#persona-apellidos").val();
            dirccionp = $("#persona-direccion").val()
            if (cedulap == "") {
                alert("Campo cedula esta vacio");
                $("#persona-cedula").focus();
                return false;
            } else if (isNaN(parseInt(cedulap))) {
                alert('campo cedula debe ser numerico');
                $("persona-cedula").focus();
                return false;
            } else if (nombrep == "") {
                alert(" campo nombre esta  vacio! ");
                $("#persona-nombres").focus();
                return false;
            } else if (apellidop == "") {
                alert("campo apellido esta vacio !!");
                $("#persona-apellidos").focus();
                return false;
            }
            $.ajax({
                type: "POST",
                url: 'actualizapersona',
                data: {cedula: $('#persona-cedula').val(),
                    nombres: $('#persona-nombres').val(),
                    apellidos: $('#persona-apellidos').val(),
                    direccion: $('#persona-direccion').val(),
                    fnacimiento: $('#persona-fnacimiento').val(),
                    sexo:sexo,
                    tlf1: $('#persona-tlf1').val(),
                    correoe: $('#persona-correoe').val()
                    
                },
                success: function (response) {
                    console.log(response);
                    //limpiamos formulario personas al insertar datos de personas
                    $('#persona-cedula').val('');
                    $('#persona-nombres').val('');
                    $('#persona-apellidos').val('');
                    $('#persona-direccion').val('');
                    $('#persona-correoe').val('');
                    $('#persona-tlf1').val('');
                    $('#persona-fnacimiento').val('');
                    $('#seguridadusuarios-cedula').val('');
                    $('#mensajero').slideUp(500);
                    $('#seguridadusuarios-login').removeAttr("disabled").val('');
                    alert('Datos de personas Fueron Ingresados con Exito....');
                    
                   //location.reload(); 
                },
                error: function () {
                    alert("Datos Actualizados");
                }
            });
        });//funcion
</script>
