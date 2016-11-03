<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TipoAviso;
use app\models\EstadoAviso;

/* @var $this yii\web\View */
/* @var $model app\models\Aviso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aviso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'tipo_aviso_id')->textInput() ?>

    <?= $form->field($model, 'tipo_aviso_id')->label('Tipo de aviso')->widget(Select2::className(), [
            'data' => ArrayHelper::map(TipoAviso::find()->addOrderBy('id')->all(), 'id', 'nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione ...'],
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]); 
    ?>

    <?php //$form->field($model, 'estado_aviso_id')->textInput() ?>

    <?= $form->field($model, 'estado_aviso_id')->hiddenInput(['id' => 'estado_aviso_id'])->label(false) ?>

    <?php //$form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['id' => 'created_by'])->label(false) ?>


    <?= $form->field($model, 'perro_id')->textInput()->label('Nombre del perro') ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->hiddenInput(['id' => 'created_at'])->label(false) ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['id' => 'updated_at'])->label(false) ?>

    <?php //$form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->hiddenInput(['id' => 'updated_by'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Publicar' : 'Actualizar aviso', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
