<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\AdoptanteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adoptante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'estado_adoptante_id') ?>

    <?= $form->field($model, 'tiene_otros_perros') ?>

    <?= $form->field($model, 'tiene_ninios') ?>

    <?php // echo $form->field($model, 'tiene_patio_cerrado') ?>

    <?php // echo $form->field($model, 'tiene_gatos') ?>

    <?php // echo $form->field($model, 'deja_casa_sola_muchas_horas') ?>

    <?php // echo $form->field($model, 'puede_atender_mascota_enferma') ?>

    <?php // echo $form->field($model, 'acepta_visitas_de_control') ?>

    <?php // echo $form->field($model, 'comentarios') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
