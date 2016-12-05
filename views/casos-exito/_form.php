<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CasosExito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="casos-exito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aviso_id')->hiddenInput(['value' => $modelAviso->id])->label(false) ?>

    <?= $form->field($model, 'perro_id')->hiddenInput(['value' => $modelPerro->id])->label(false) ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-paw"></i> Nos hace felices saber que todo salió bien!! Contanos tu experiencia!! </h4></div>
        <div class="panel panel-body">
            <div class="panel panel-body panel-info">
                <?= $form->field($model, 'mensaje')->textarea(['rows' => 6, 'placeholder' => 'Contanos lo que sentís, cómo fue el reencuentro y todo lo que sientas que puede alentar a otros a seguir su búsqueda. Además, si te animás, compartinos una foto del reencuentro!!'])->label(false) ?>

                <?= $form->field($model, 'file')->fileInput()->label('Compartir Imagen')?>

                <?php // $form->field($model, 'foto_reencuentro')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
