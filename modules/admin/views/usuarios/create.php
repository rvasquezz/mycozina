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
 
 $("#persona-cedula").keypress(function(e) {
       if(e.which == 13) {
        e.preventDefault();
         Buscar();
       }
    });
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
   var login=$('#seguridadusuarios-login').val();
   var password=$('#seguridadusuarios-password').val();
   // var inputs= $('#form_usuario').serializeArray();

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
     
       
        function Buscar() {
             var cedull=  $('#persona-cedula').val();
             if(!cedull)
             {
                alert('Debe colocar alguna cedula');
                return false;
             }
            $.ajax({
                type: 'POST',
                url: 'buscarpersona',
                data: {cedula:cedull},
                beforeSend: function (xhr) {
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
                success: function (response) {
                   
                    $('#contenido').unblock();
                    response = JSON.parse(response);
    
                    if (response.success) {
                     

                        $('input:radio[name="Persona[sexo]"]')[response.sexo].checked = true;
                        $('input:radio[name="Persona[sexo]"]').attr('disabled', 'disabled');
                        $('#seguridadusuarios-cedula').val(response.cedula).attr('readonly', 'readonly');
                        $('#persona-nombres').val(response.nombres).attr('disabled', 'disabled');
                        $('#persona-apellidos').val(response.apellidos).attr('disabled', 'disabled');
                        $('#persona-direccion').val(response.direccion).attr('disabled', 'disabled');
                        $('#persona-tlf1').val(response.telefono).attr('disabled', 'disabled');
                        $('#persona-correoe').val(response.correo).attr('disabled', 'disabled');
                        $('#persona-fnacimiento').val(response.fnacimiento).attr('disabled', 'disabled');
                        //$('input:radio[name="Persona[sexo]"]')[response.sexo].checked = true;
                        $('#mensajero').slideUp(500);
                        $('#div_insertapersona').slideUp(500);
                        $('#cedulausuario').val(response.cedulau);
                        $('#seguridadusuarios-password').removeAttr("disabled").val('');
                        Buscarlogin();
                        
                    }
                    if (response.false) {
                         $('#ocultar_usuario').hide('slow');
                         $('#validador').hide();
                        //remover atributo disable
                        $('#seguridadusuarios-cedula').val(cedull);
                        $('#seguridadusuarios-login').val("");
                        
                        $('#persona-fnacimiento').val(response.fnacimiento).attr('disabled', false);
                        $('#persona-nombres').removeAttr("disabled").val(response.nombre1+' '+response.nombre2);
                        $('#persona-apellidos').removeAttr("disabled").val(response.apellido1+' '+response.apellido2);
                        $('#persona-direccion').removeAttr("disabled").val('');
                        $('#persona-tlf1').removeAttr("disabled").val('');
                        $('#persona-correoe').removeAttr("disabled").val('');
                        $('#mensajero').html(' Aviso : Cedula no registrada en nuestro Sistema!<br> Debes registrar los datos de la persona').slideDown(500);
                        $('#pan').show();
                        $('input:disabled').attr('disabled',false);

                          $('#seguridadusuarios-cedula').attr('readonly', 'readonly');
                        //$('#seguridadusuarios-password').attr('disabled', 'true');
                        //DESPLEGAR BOTON INSERTAR personaS
                        $('#div_insertapersona').slideDown(500);

                    }
                }, //success
                error: function (error) {
                    $('#contenido').unblock();
                },
            }); //ajax
        }//funcion Buscar
        //validar password-confirm
</script>
<script>                      //enviar formulario personas


        $("#pan").click(function () {
          var sexo= $('input:radio[name="Persona[sexo]"]:checked').val();
          var correoo  =$("#persona-correoe").val();
          expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            cedulap = $("#persona-cedula").val();
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

            if (correoo == "") 
            {
                alert("Campo correo vacio");
                $("#persona-correoe").focus();
                return false;
            } 

            if (cedulap == "") 
            {
                alert("Campo cedula esta vacio");
                $("#persona-cedula").focus();
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
            if (isNaN(parseInt(cedulap))) 
            {
                alert('campo cedula debe ser numerico');
                $("persona-cedula").focus();
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
             if ( !expr.test(correoo) )
             {
                alert("Error: La dirección de correo " + correoo + " es incorrecta.");
                return false;
            }        

            $.ajax({
                type: "POST",
                url: 'insertapersona',
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
                    $('#persona-cedula').val(response.cedula).change();
                    // $('#persona-nombres').val('');
                    // $('#persona-apellidos').val('');
                    // $('#persona-direccion').val('');
                    // $('#persona-correoe').val('');
                    // $('#persona-tlf1').val('');
                    // $('#persona-fnacimiento').val('');
                    // $('#seguridadusuarios-cedula').val('');
                    // $('#mensajero').slideUp(500);
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
<!--valida cedula con ajax-->
<script>

      //  $('#seguridadusuarios-cedula').focus();
        function Buscarlogin() {

       
            $.ajax({
                type: "POST",
                url: 'validar',
                data: {cedula: $('#seguridadusuarios-cedula').val()},
                success: function (response) {
                    response = JSON.parse(response);
                    var logeo= response.login;
                
                    if (response.success) {
                        $('#validador').hide('slow');
                        $('#ocultar_cedula').hide();
                        $('#ocultar_usuario').show('slow');
                        $('#div_validacedula').html(' Aviso : Cedula ya tiene asignado un Usuario !').slideDown(500);
                        $('#seguridadusuarios-login').val(response.login);
                        $('.createe').attr('disabled', 'disabled');
                        $('#ocultoiddireccion').val(response.iddireccion);

                        //cambiar el select2

                        if (logeo.length >0) {
                         $('#seguridadusuarios-login').attr('disabled', 'disabled');
                        }
                        else{ $('#seguridadusuarios-login').removeAttr('disabled');}

                        $('#seguridadusuarios-login').val(logeo);

                                }
           
                    if (response.false) {
                        $('#ocultar_usuario').show('slow');
                        $('#ocultar_cedula').show('slow');
                        $('#validador').show('slow');
                        $("#validador").removeAttr("disabled");
                        $("#seguridadusuarios-login").removeAttr("disabled").val('');
                        $("#seguridadusuarios-password").removeAttr("disabled").val('');
                        $("#persona-cedula").focus();
                        $('#div_validacedula').slideUp(500);
                    } //if false
                },
                error: function () {
                    alert('introduzca numero de cedula');
                    $('#pan').hide();
                }
            });//ajax
        } //function buscar login



</script>
