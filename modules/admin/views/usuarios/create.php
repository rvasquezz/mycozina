<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SeguridadUsuarios */

$this->title = Yii::t('app', 'Registrar Usuarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seguridad Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguridad-usuarios-create">

    <!-- <h1 align="center"><?= Html::encode($this->title) ?></h1> -->
 
    <br><br>
    <?= $this->render('_form', ['model' => $model,'person'=>$person]) ?>

</div>
<script>        
 

  $("#seguridadusuarios-login").keypress(function(e) {
       if(e.which == 13) {
        e.preventDefault();
       }
    });
  $("#seguridadusuarios-password").keypress(function(e) {
       if(e.which == 13) {
        e.preventDefault();
       }
    });
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
     
  
</script>
<script>                      //enviar formulario personas


        $("#pan").click(function () {
          var sexo= $('input:radio[name="Persona[sexo]"]:checked').val();

          
            nombrep = $("#persona-nombres").val();
            apellidop = $("#persona-apellidos").val();
            dirccionp = $("#persona-direccion").val();
            fnacimiento = $("#persona-fnacimiento").val();
            tlf1=$("#persona-tlf1").val();

             if (tlf1 == "") 
            {
                alert("Campo telefono vacio");
                $("#persona-tlf1").focus();
                return false;
            } 

            if (fnacimiento== "") 
            {
                alert("Fecha de nacimiento vacia");
                $("#persona-fnacimiento").focus();
                return false;
            } 
             if (!sexo) 
            {
                alert("Campo sexo esta vacio");
                return false;
            } 

            if (nombrep == "") 
            {
                alert("campo nombre esta  vacio!");
                $("#persona-nombres").focus();
                return false;
            }  
            if (apellidop == "") 
            {
                alert("campo apellido esta vacio!!");
                $("#persona-apellidos").focus();
                return false;
            }
 

            $.ajax({
                type: "POST",
                url: 'insertapersona',
                data: 
                    nombres: $('#persona-nombres').val(),
                    apellidos: $('#persona-apellidos').val(),
                    direccion: $('#persona-direccion').val(),
                    fnacimiento: $('#persona-fnacimiento').val(),
                    sexo:sexo,
                    tlf1: $('#persona-tlf1').val()                    
                },
                success: function (response) {
                    console.log(response);
              
                    $('#seguridadusuarios-login').removeAttr("disabled").val('');
                    alert('Datos de personas Fueron Ingresados con Exito....');
                   // location.reload(); 
                },
                error: function () {
                    alert("datos duplicados");
                }

            });
        });//function
   
</script>
