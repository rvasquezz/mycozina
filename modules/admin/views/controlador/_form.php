<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Controlador */
/* @var $form yii\widgets\ActiveForm */
$modulo= new app\modules\admin\models\Modulo;
?>

<div class="controlador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_modulo')->widget(Select2::classname(), [
      'model' => $modulo,
      'attribute' => 'descripcion',
      'data'=>Arrayhelper::map($modulo::find()->all(), 'id_modulo', 'descripcion'),
        'options' => ['placeholder' => 'Seleccione una sede ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],])->label('Modulo');?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true])->label('Descripción del controlador') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
