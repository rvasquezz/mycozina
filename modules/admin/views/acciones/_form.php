<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Modulo;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Acciones */
/* @var $form yii\widgets\ActiveForm */
$controlador= new app\modules\admin\models\Controlador; 
?>

<div class="acciones-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'id_controlador')->widget(Select2::classname(), [
      'model' => $controlador,
      'attribute' => 'descripcion',
      'data'=>Arrayhelper::map($controlador::find()->all(), 'id_controlador', function($data){
        return $data->descripcion.'/'.Modulo::findOne($data->id_modulo)->descripcion;
      }),
        'options' => ['placeholder' => 'Seleccione un Controlador ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],])->label('Controlador/Modulo');?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
