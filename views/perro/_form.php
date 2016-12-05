<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Perro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_perro_id')->textInput() ?>

    <?= $form->field($model, 'estado_clinico_id')->textInput() ?>

    <?= $form->field($model, 'color_primario')->textInput() ?>

    <?= $form->field($model, 'color_secundario')->textInput() ?>

    <?= $form->field($model, 'raza_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
