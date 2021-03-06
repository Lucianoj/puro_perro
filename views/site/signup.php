<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Localidad;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\PermisosHelpers;
use app\models\Rol;

$es_root = !Yii::$app->getUser()->isGuest && PermisosHelpers::requerirMinimoRol('root');
$es_admin = !Yii::$app->getUser()->isGuest && PermisosHelpers::requerirMinimoRol('admin');

$this->title = ' Alta de Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1 class="text-center"><i class="fa fa-user"></i><?= Html::encode($this->title)?></h1><br>

    <div class="row">
        <div class="col col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="text-default"><i class="fa fa-exclamation-triangle"></i> Por favor complete sus datos</h4>
                    <div class="text-warning">(*) Campos Obligatorios</div>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

                        <?= $form->field($model, 'apodo')->textInput(['maxlength' => true, 'id' => 'address', 'placeholder' => 'NickName o apodo, como te gusta que te llamen!']) ?>

                        <div class="row">
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'nombre') ?>
                            </div>
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'apellido') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-9">
                                <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true, 'id' => 'address', 'placeholder' => 'Calle Ejemplo 123, Neuquén, Neuquén']) ?>
                            </div>
                            <div class="col col-lg-3">
                                <label class="control-label" for="enviar">Mapa (*)</label>
                                <a class="btn btn-info form-control" id="enviar" value="Geocode">Verificar &raquo;</a>
                            </div>
                        </div>

                        <?= $form->field($model, 'localidad_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(Localidad::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]); ?>

                        <div class="row">
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'telefono_celular') ?>
                            </div>
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'telefono_fijo') ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'email') ?>

                        <div class="row text-info">
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'ofrece_transito')->checkbox(['yes', 'no']) ?>
                            </div>
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'desea_adoptar')->checkbox(['yes', 'no']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                            <div class="col col-lg-6">
                                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'latitud')->hiddenInput(['id' => 'lat'])->label(false) ?>

                        <?= $form->field($model, 'longitud')->hiddenInput(['id' => 'long'])->label(false) ?>

                        <?php
                            if($es_root || $es_admin) {
                                echo $form->field($model, 'rol_id')->widget(Select2::className(), [
                                    'data' => ArrayHelper::map(Rol::find()->addOrderBy('rol_nombre')->all(), 'id', 'rol_nombre'),
                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione Rol'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                                ]);
                            }
                        ?>

                        <div class="form-group">
                            <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="panel panel-body panel-info">
                <div id='map' style='width:520px; height:400px;'></div>
            </div>
        </div>
    </div>
</div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: -38.9516784, lng: -68.05918880000002} //Neuquén
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('enviar').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
                jQuery('#lat').val(results[0].geometry.location.lat());
                jQuery('#long').val(results[0].geometry.location.lng());
            } else {
                alert('Geolocalización falló: ' + status);
            }
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls&callback=initMap" async defer></script>