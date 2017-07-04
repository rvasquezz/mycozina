<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use yii\helpers\Url;
    

 
  ?>
  <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 align="center">Restablecer Contraseña</h3></div>
        <div class ="panel-body">
          
           <?php $form = ActiveForm::begin() ?>

                       
              <div class="form-group">
            
              <?= $form->field($model, 'password')->passwordInput(['name'=>'password'])->label('Nueva Contraseña')->hint('Introduzca la nueva Contraseña');?>
              <?= $form->field($model, 'password_repeat')->passwordInput(['required'=>true])->label('Confirme Contraseña')->hint('Confirme Contraseña') ?>
              
             </div>
                
                 
              <div class="form-group">
                <button type="submit" class="btn btn-info">Enviar</button>
              </div>
                

                        <?php ActiveForm::end(); ?>
               

                
           

        </div><!--body-->

    </div>

</div>
