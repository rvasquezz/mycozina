<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\DatePicker;
?>
            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">Home</a></li>
                     <li><a href="#">Search results</a></li>
                     <li>Profile</li>
                  </ul>
               </div>
            </div>
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                               <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                                     <div class="row">
                                        <div class="form-group col-sm-6">
                                            <?= $form->field($model, 'nombres')->textInput() ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <?= $form->field($model, 'apellidos')->textInput() ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                           <?= $form->field($model, 'email')->textInput()->label('Correo electronico'); ?>
                                           <!-- <small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small>  -->
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <?= $form->field($model, 'tlf1')->textInput()->label('Telefono'); ?>

                                           <!-- <small class="form-text text-muted">We"ll never share your email with anyone else.</small>  -->
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <?= $form->field($model, 'password_repeat')->passwordInput()->label('Repita la contraseña') ?>
                                        </div>
                                        <div class="form-group col-sm-6">

                                            <?= $form->field($model, 'sexo')->radioList(['male'=>'Masculino','female'=>'Femenino'])->label('sexo') ?>
    
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <?= $form->field($model, 'fnacimiento')->widget(DatePicker::classname(), [
                                            'name' => 'fnacimiento',
                                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                            'options' => ['placeholder' => 'Introduce una Fecha ...','maxlength'=>'10'],
                                            'pluginOptions' => [
                                            'autoclose'=>true,
                                            'format' => 'dd-mm-yyyy'
                                            ]
                                            ])->label('Fecha de Nacimiento'); ?>
                                          
                                        </div>
                                        <div class="form-group col-sm-12">
                                           <label for="exampleTextarea">Example textarea</label>
                                           <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="form-group col-sm-6">
                                           <div class="btn-group" data-toggle="buttons" >
                                        
                                              <label class="btn btn-secondary">
                                              <input type="radio" name="options" value="1" > Cliente </label>
                                              <label class="btn btn-secondary">
                                              <input type="radio" name="options"  value="2" > Cocinero </label>
                                              <label class="btn btn-secondary">
                                              <input type="radio" name="options"  value="3" > Ambos </label>
                                            
                                           </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-sm-4">
                                            <p><?= Html::submitButton('Registrar', ['class' => 'btn theme-btn', 'name' => 'signup-button']) ?></p>
                                        </div>
                                     </div>
                                <?php ActiveForm::end(); ?>
                           </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                     <!-- WHY? -->
                     <div class="col-md-4">
                        <h4>El registro es rápido, fácil y gratuito.</h4>
                        <p>Una vez registrado, puede:</p>
                        <hr>
                        <img src="http://placehold.it/400x300" alt="" class="img-fluid">
                        <p></p>
                        <div class="panel">
                           <div class="panel-heading">
                              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle collapsed" href="#faq1" aria-expanded="false"><i class="ti-info-alt" aria-hidden="true"></i>Ser cocinero?</a></h4>
                           </div>
                           <div class="panel-collapse collapse" id="faq1" aria-expanded="false" role="article" style="height: 0px;">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum ut erat a ultricies. Phasellus non auctor nisi, id aliquet lectus. Vestibulum libero eros, aliquet at tempus ut, scelerisque sit amet nunc. Vivamus id porta neque, in pulvinar ipsum. Vestibulum sit amet quam sem. Pellentesque accumsan consequat venenatis. Pellentesque sit amet justo dictum, interdum odio non, dictum nisi. Fusce sit amet turpis eget nibh elementum sagittis. Nunc consequat lacinia purus, in consequat neque consequat id. </div>
                           </div>
                        </div>
                        <!-- end:panel -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle" href="#faq2" aria-expanded="true"><i class="ti-info-alt" aria-hidden="true"></i>Ser cliente?</a></h4>
                           </div>
                           <div class="panel-collapse collapse" id="faq2" aria-expanded="true" role="article">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum ut erat a ultricies. Phasellus non auctor nisi, id aliquet lectus. Vestibulum libero eros, aliquet at tempus ut, scelerisque sit amet nunc. Vivamus id porta neque, in pulvinar ipsum. Vestibulum sit amet quam sem. Pellentesque accumsan consequat venenatis. Pellentesque sit amet justo dictum, interdum odio non, dictum nisi. Fusce sit amet turpis eget nibh elementum sagittis. Nunc consequat lacinia purus, in consequat neque consequat id. </div>
                           </div>
                        </div>
                        <!-- end:Panel -->
                        <h4 class="m-t-20">Póngase en contacto con atención al cliente</h4>
                        <p> Si está buscando más ayuda o tiene una pregunta que hacer, por favor </p>
                        <p> <a href="contact.html" class="btn theme-btn m-t-15">Contáctenos</a> </p>
                     </div>
                     <!-- /WHY? -->
                  </div>
               </div>
            </section>
