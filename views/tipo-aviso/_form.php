<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAviso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-aviso-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading"><h4 class="text-default"><i class="fa fa-exclamation-triangle"></i> Por favor complete el dato solicitado</h4></div>
            <div class="panel-body">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Cargar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
