<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\bootstrap\Modal;
use kartik\widgets\Select2;
use kartik\widgets\AlertBlock;
use yii\widgets\Pjax;
use kartik\password\PasswordInput;
use app\modules\admin\models\Persona;
use app\modules\admin\models\SeguridadUsuarios;
use kartik\widgets\DatePicker;
use yii\helpers\Url;
echo AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => AlertBlock::TYPE_ALERT,
    'delay' => 7000,
]); 
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SeguridadUsuarios */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="seguridad-usuarios-form">


 <a href='index' class="btn btn-danger">Volver</a>
 
 <br><br>
        <div class="main row">


            <div class ="col-md-7 column">
                <div class="panel panel-primary">
                    <div class="panel-heading">DATOS DE PERSONAS</div>
                    <div class="panel-body">
                        <div id="mensajero"  style="font-size:16px;color:red;display:none"> 
                        </div>
                        <?php $form = ActiveForm::begin(['id' => 'form_personas']) ?>
                        <div class="main row">
                
                            <div class="col-xs-6">
                                <?= $form->field($person, 'nombres')->textInput(['required' => true, 'placeholder' => 'introduzca nombre persona','onKeyPress'=>'return soloLetras(event)']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?= $form->field($person, 'apellidos')->textInput(['required' => true, 'placeholder' => 'introduzca apellido persona','onKeyPress'=>'return soloLetras(event)']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?= $form->field($person, 'direccion')->textInput(['required' => true, 'placeholder' => 'introduzca direccion']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?=
                                $form->field($person, 'fnacimiento')->widget(DatePicker::classname(), [
                                'name' => 'fnacimiento', 'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'options' => ['placeholder' => 'Fecha de Nacimiento ...','onKeyPress'=>'return soloNumeros(event)'],
                                'pluginOptions' => ['autoclose' => true, 'format' => 'dd-mm-yyyy']])->label('Fecha de nacimiento')
                                ?>
                            </div>
                            <div class="col-xs-3">
                                <?= $form->field($person, 'tlf1')->textInput(['placeholder' => 'telefono','onKeyPress'=>'return soloNumeros(event)'])->label('Telefono'); ?>
                            </div>
                           
                            <div class="col-xs-4">
                                <?= $form->field($person, 'sexo')->radioList(array('F'=>'Femenino','M'=>'Masculino')); ?>
                            </div>
                        </div>
                            
                                <div id="act_persona" style="display:none;">   
                                <button  class="btn btn-primary" id="act_persona">Modificar</button>
                                </div>
                                
                            <button type="button" id ="pan" class="btn btn-success">Crear Persona</button>
                            
                         <br><br>
                         <!--<spam id="pan"><a href src="#">pan</a></spam> <br>-->
                    </div><!--panel-body-->
                </div> <!--panel-->
            </div>

            <div class="col-md-5 column" >
                <div class="panel panel-primary">
                    <div class="panel-heading">DATOS DE USUARIO</div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['id' => 'form_usuario']) ?>
                            
    


                        <?= $form->field($model, 'login')->textInput(['maxlength' => true, 'placeholder' => 'Introduzca usuario']) ?>

                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'introduzca password']) ?>

                        <br><br>

 
                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'validador']) ?>
                              
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div><!--panel-body-->
                </div> <!--panel-->

               
            </div><!--col-md-5-->
        </div><!--row-->
        <?php ActiveForm::end(); 
        ?>
  
</div><!--form-->


