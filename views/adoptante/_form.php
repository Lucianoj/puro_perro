<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\PermisosHelpers;
use kartik\select2\Select2;
use app\models\EstadoAdoptante;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Adoptante */
/* @var $form yii\widgets\ActiveForm */

$es_usuario_registrado = !Yii::$app->user->isGuest && ($user_id == Yii::$app->user->id);
$es_root_o_admin = !Yii::$app->user->isGuest && (PermisosHelpers::requerirRol('admin') || PermisosHelpers::requerirRol('root'));
$sino =  [['id' => '0', 'nombre' => 'No'], ['id' => '1', 'nombre' => 'Sí']];
$subtitulo = ($user_id != 0)? ' Hola '.$modelUser->nombre.', completá estas preguntas por favor.':' Complete el formulario Por favor';
?>

<div class="adoptante-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-info-circle"></i> <?=$subtitulo?></h4></div>
                <div class="panel-body">
                    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_id])->label(false)?>
                    <?php if($model->isNewRecord) echo $form->field($model, 'estado_adoptante_id')->hiddenInput(['value' => 1])->label(false);?>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                                echo  $form->field($model, 'tiene_otros_perros')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                                echo  $form->field($model, 'tiene_ninios')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                                    'language' => 'es',
                                    //                'value' => 'No',
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                                echo  $form->field($model, 'tiene_patio_cerrado')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                                    'language' => 'es',
                                    //                'value' => 'No',
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                                echo  $form->field($model, 'tiene_gatos')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                                    'language' => 'es',
                                    //                'value' => 'No',
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <?php
                                echo  $form->field($model, 'deja_casa_sola_muchas_horas')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                                    'language' => 'es',
                                    //                'value' => 'No',
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                                echo  $form->field($model, 'puede_atender_mascota_enferma')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                                    'language' => 'es',
                                    //                'value' => 'No',
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                                echo  $form->field($model, 'acepta_visitas_de_control')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                                    'language' => 'es',
                                    //                'value' => 'No',
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'comentarios')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                    <?php
                    if($es_root_o_admin) { ?>
                        <div class="text-center"><hr>
                            <h3 class="text-warning"> Zona para Administrador </h3>
                        </div>
                        <div class="text-danger">
                            <?php
                                if(!$model->isNewRecord) {
                                    echo  $form->field($model, 'estado_adoptante_id')->widget(Select2::className(), [
                                        'data' => ArrayHelper::map(EstadoAdoptante::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                                        'language' => 'es',
                                        'options' => ['placeholder' => 'Seleccione ...'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ]
                                    ]);
                                }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-danger">
                                <?= $form->field($model, 'nota_admin')->textInput(); ?>
                            </div>
                        </div>
                    <?php
                        }
                    ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Cargar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
