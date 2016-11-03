<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoAviso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-aviso-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-info">
        <div class="panel-heading"><h4 class="text-default"><i class="fa fa-exclamation-triangle"></i> Por favor complete los datos solicitados</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col col-lg-8">
                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col col-lg-4">
                    <?= $form->field($model, 'valor')->textInput() ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Cargar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>


        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
