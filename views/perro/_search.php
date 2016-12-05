<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PerroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'estado_perro_id') ?>

    <?= $form->field($model, 'estado_clinico_id') ?>

    <?= $form->field($model, 'color_primario') ?>

    <?php // echo $form->field($model, 'color_secundario') ?>

    <?php // echo $form->field($model, 'raza_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
