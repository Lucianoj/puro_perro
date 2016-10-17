<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Localidad;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading"><h4 class="text-default"><i class="fa fa-exclamation-triangle"></i> Por favor complete sus datos</h4></div>
                <div class="panel-body">

                    <?= $form->field($model, 'apodo') ?>

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
                            <label class="control-label" for="enviar">Mapa</label>
                            <a class="btn btn-default form-control" id="enviar" value="Geocode">Verificar &raquo;</a>
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

                    <?= $form->field($model, 'latitud')->hiddenInput(['id' => 'lat'])->label(false) ?>

                    <?= $form->field($model, 'longitud')->hiddenInput(['id' => 'long'])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Cargar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="panel panel-body panel-info">
                <div id='map' style='width:520px; height:400px;'></div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
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
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls&signed_in=true&callback=initMap" async defer></script>
