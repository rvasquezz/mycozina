<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="restaurant-wrap" align="center">


    <section class="contact-page inner-page">
         <div class="container ">
          <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Recordarme') ?>

                <!-- <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div> -->

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
              
            <?php ActiveForm::end(); ?>
            <div class="social-auth-links">
                <p>  Inicie sesión con: </p>
                <div id="w0" >
                    <ul class="auth-clients">
                    
                        <li>
                            <a class="facebook auth-link" href="auth?authclient=facebook" title="Facebook"><img src="../images/facebook.png" class="img-responsive"> 
                            </a>
                        </li>
                    </ul>
                    <ul class="auth-clients">
                    
                        <li>
                            <a class="facebook auth-link" href="#"" title="Gmail"><img src="../images/gmail.png" class="img-responsive"> 
                            </a>
                            <!-- <a class="facebook auth-link" href="auth?authclient=google" title="Gmail"><img src="../images/gmail.png" class="img-responsive">  -->
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.social-auth-links -->

            <a href="#">Olvidé mi contraseña</a><br>
            <a href="signup" class="text-center">Crear nuevo usuario</a>
        </div>
    </section>
</div>
