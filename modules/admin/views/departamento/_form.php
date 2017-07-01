<?php

use app\modules\admin\models\Persona;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Departamento */
/* @var $form yii\widgets\ActiveForm */
$persona= new Persona();
?>

<div class="departamento-form">

    <?php $form = ActiveForm::begin(); ?>

      <div class="main row">
		<div class="col-md-5 column">
			<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-2 column">
			<?= $form->field($model, 'sufijo')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-5 column">
			<?= $form->field($model, 'encargado')->widget(Select2::classname(), [
			'model' => $persona,
			'attribute' => 'descripcion',
			'data'=>Arrayhelper::map($persona::find()->all(),'cedula', function($data)
			{return Html::encode($data->nombres.' '.$data->apellidos );    }),
			'options' => ['placeholder' => 'Seleccione un encargado...'],
			'pluginOptions' => [
			'allowClear' => true
			],])->label('Encargado'); ?>
		</div>


      </div>
       
  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Registrar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="?r=admin/departamento" title="Volver" class="btn btn-danger">Volver</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>