<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\search\AvisoSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
    function ordenarFechaParaMostrar($fecha) {
        //Si la fecha es la de la base, debera ser YYYY-MM-DD
        $separador = '/';
        $auxFechaAnio = substr($fecha, 0, 4);
        $auxFechaMes = substr($fecha, 5, 2);
        $auxFechaDia = substr($fecha, 8, 2);

        // devuelve dd/mm/aaaa HH:MM
        return $auxFechaDia.$separador.$auxFechaMes.$separador.$auxFechaAnio;
    }
?>
<div class="aviso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'tipo_aviso_id') ?>

    <?php // echo $form->field($model, 'estado_aviso_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

<!--    <div class="panel panel-info">-->
<!--    <div class="row text-info text-center">-->
            <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                <?= $form->field($model, 'keyword')->textInput(['placeholder' => 'Palabra clave...'])->label(false)?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                <?= $form->field($model, 'fecha_filtro')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => date('d/m/Y')],
                    'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy',
                    ]
                ])->label(false);
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                <?= Html::submitButton('<i class="fa fa-search"></i> Filtrar Avisos', ['class' => 'btn btn-md btn-primary'])?>
            </div>

<!--    </div>-->
<!--    </div>-->
    <?php // echo $form->field($model, 'perro_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

        <?php // echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>

    <?php ActiveForm::end(); ?>

</div>
