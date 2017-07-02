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
  var  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   var login=$('#seguridadusuarios-login').val();
   var password=$('#seguridadusuarios-password').val();
   // var inputs= $('#form_usuario').serializeArray();

   if(!login)
   {
        alert('Debe colocar un login');
        return false;
   }
   if(!password)
   {
        alert('Debe colocar un password');
        return false;
   }
   if(password.length<6)
   {
        alert('Debe colocar un password con mas de 6 dígitos');
        return false;
   }
    if ( !expr.test(login) )
 {
    alert("Error: La dirección de correo " + correoo + " es incorrecta.");
    return false;
}        

   
});

    
     
     
        $("#act_persona").click(function () {
          var sexo= $('input:radio[name="Persona[sexo]"]:checked').val();
     

           
            nombrep = $("#persona-nombres").val();
            apellidop = $("#persona-apellidos").val();
            dirccionp = $("#persona-direccion").val()
           
           if (nombrep == "") {
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
                data: {
                    nombres: $('#persona-nombres').val(),
                    apellidos: $('#persona-apellidos').val(),
                    direccion: $('#persona-direccion').val(),
                    fnacimiento: $('#persona-fnacimiento').val(),
                    sexo:sexo,
                    tlf1: $('#persona-tlf1').val()
                    
                },
                success: function (response) {
                    console.log(response);
                    //limpiamos formulario personas al insertar datos de personas
                  
                    $('#persona-nombres').val('');
                    $('#persona-apellidos').val('');
                    $('#persona-direccion').val('');
                   
                    $('#persona-tlf1').val('');
                    $('#persona-fnacimiento').val('');
          
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
