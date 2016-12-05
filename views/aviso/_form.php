<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TipoAviso;
use app\models\EstadoAviso;
use app\models\EstadoPerro;
use app\models\EstadoClinico;
use app\models\Color;
use app\models\Raza;
use app\models\PermisosHelpers;
use yii\helpers\Url;
use app\models\Tamanio;
use app\models\TipoPelo;
use app\models\Sexo;
use kartik\date\DatePicker;

$es_root = !Yii::$app->getUser()->isGuest && PermisosHelpers::requerirMinimoRol('root');
$es_admin = !Yii::$app->getUser()->isGuest && PermisosHelpers::requerirMinimoRol('admin');
$es_autor =  !Yii::$app->getUser()->isGuest && (!$model->isNewRecord && (Yii::$app->getUser()->id == $model->created_by));
$perdido_o_encontrado = (($tipo_aviso == 1) or ($tipo_aviso == 2));
/* @var $this yii\web\View */
/* @var $model app\models\Aviso */
/* @var $form yii\widgets\ActiveForm */

if (Yii::$app->getUser()->isGuest)
    Yii::$app->getResponse()->redirect(Url::to(['site/login']));
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
<?php
    $sino =  [['id' => '0', 'nombre' => 'No'], ['id' => '1', 'nombre' => 'Sí'],['id' => '2', 'nombre' => 'No lo sé']];
    $título = '';
    switch ($tipo_aviso) {
        case 1:{
            $titulo = 'Perro Perdido';
            $placeholderTitulo = 'Ej: "Buscamos a Tom!"';
            $placeholderInfo = 'Agregue aquí cualquier información que considere importante, por ejemplo, si el perro tiene collar, si está bajo algún tratamiento médico, si es una perra y está en celo, etc.';
            break;
        }
        case 2:{
            $titulo = 'Perro Encontrado';
            $placeholderTitulo = 'Ej: "Perrita encontrada en el río..!"';
            $placeholderInfo = 'Agregue aquí cualquier información que considere importante, por ejemplo, si el perro está lastimado o si tiene alguna marca identificatoria visible.';
            break;
        }
        case 3:{
            $titulo = 'Perro en Adopción';
            $placeholderTitulo = 'Ej: "Firulais busca hogar..."';
            $placeholderInfo = 'Agregue aquí cualquier información que considere importante, por ejemplo, si el perro no se lleva bien con otras mascotas, o si tiene alguna necesidad especial.';
            break;
        }
        default :{
            $titulo = 'Crear Aviso';
            $placeholderTitulo = 'Título llamativo SIN GRITAR';
            $placeholderInfo = 'Agregue aquí cualquier información que considere importante.';
            break;
        }
    }
?>
<?php
    if($model->isNewRecord) { ?>
        <h1 class="text-center"><i class="fa fa-bullhorn"></i><?= Html::encode(' ' . $titulo) ?></h1><br><br>
    <?php }
?>


<div class="aviso-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-info-circle"></i> Complete los datos del Aviso</h4></div>
            <div class="panel-body">
                <?php
                if ($model->isNewRecord) {
                    echo $form->field($model, 'estado_aviso_id')->hiddenInput(['value' => 1])->label(false);
                    echo $form->field($model, 'tipo_aviso_id')->hiddenInput(['value' => $tipo_aviso])->label(false);

                } else {
                    if($es_root || $es_admin) {
                        echo  $form->field($model, 'estado_aviso_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(EstadoAviso::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ])->label('Estado del Aviso, solo para Administrador');
                    }
                    if($es_root || $es_admin || $es_autor) {
//                        echo  $form->field($modelPerro, 'estado_perro_id')->widget(Select2::className(), [
//                            'data' => ArrayHelper::map(EstadoPerro::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
//                            'language' => 'es',
//                            'options' => ['placeholder' => 'Seleccione ...'],
//                            'pluginOptions' => [
//                                'allowClear' => true,
//                            ]
//                        ]);
                    }
                }
                ?>
                <div class="row">
                <?php
                    if($perdido_o_encontrado) { ?>
                        <div class="col-sm-8">
                            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder' => $placeholderTitulo]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                                if($model->isNewRecord) {
                                    echo $form->field($model, 'fecha_evento')->widget(DatePicker::classname(), [
                                        'options' => ['placeholder' => 'dd/mm/aaaa'],
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'dd/mm/yyyy',
                                            ]
                                        ])->label('Cuándo Sucedió?');
                                } else {
                                    echo $form->field($model, 'fecha_evento')->widget(DatePicker::classname(), [
                                        'options' => ['value' => ordenarFechaParaMostrar($model->fecha_evento)],
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'dd/mm/yyyy',
                                            ]
                                        ])->label('Cuándo Sucedió?');
                                }
                            ?>
                        </div>

                <?php
                    } else {
                        if($model->isNewRecord) {
                            echo $form->field($model, 'fecha_evento')->hiddenInput(['value' => date('Y-m-d')])->label(false);
                        }?>
                        <div class="col-sm-12">
                            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder' => $placeholderTitulo]) ?>
                        </div>
                <?php
                    }
                ?>
                </div>
                <div class="row">
                    <?php
                        if($model->isNewRecord) { ?>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'informacion')->textarea(['rows' => 4, 'placeholder' => $placeholderInfo]) ?>
                            </div>
                        <?php
                        } else { ?>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'informacion')->textarea(['rows' => 8, 'placeholder' => $placeholderInfo]) ?>
                            </div>
                            <div class="col-sm-4">
                                <img  class="img-responsive" src="<?=$modelPerro->foto?>" alt="<?=$modelPerro->nombre?>" width = 300></img>
                            </div>

                    <?php
                        }
                    ?>
                </div>

                <h3 class="text-info"> Datos del Perro </h3>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($modelPerro, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Firulais']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($modelPerro, 'raza_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map(Raza::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                                'language' => 'es',
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
                            echo  $form->field($modelPerro, 'sexo_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map(Sexo::find()->addOrderBy('id')->all(), 'id', 'nombre'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Seleccione ...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ]
                            ]);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                            echo  $form->field($modelPerro, 'esta_enfermo')->widget(Select2::className(), [
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
                        <?= $form->field($modelPerro, 'estado_clinico_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map(EstadoClinico::find()->addOrderBy('nombre')->all(), 'id', 'nombredescripcion'),
                                'language' => 'es',
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
                        <?= $form->field($modelPerro, 'color_primario')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(Color::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPerro, 'color_secundario')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(Color::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                            echo  $form->field($modelPerro, 'tiene_collar')->widget(Select2::className(), [
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
                        echo  $form->field($modelPerro, 'tamanio_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(Tamanio::find()->addOrderBy('id')->all(), 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        echo  $form->field($modelPerro, 'castrada')->widget(Select2::className(), [
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
                        echo  $form->field($modelPerro, 'preniada')->widget(Select2::className(), [
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
                        echo  $form->field($modelPerro, 'cola_cortada')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($sino, 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        echo  $form->field($modelPerro, 'orejas_cortadas')->widget(Select2::className(), [
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
                            echo  $form->field($modelPerro, 'le_faltan_miembros')->widget(Select2::className(), [
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
                            echo  $form->field($modelPerro, 'tipo_pelo_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map(TipoPelo::find()->addOrderBy('id')->all(), 'id', 'nombre'),
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
                        <?= $form->field($modelPerro, 'edad_estimada')->textInput(['maxlength' => true])?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                            echo  $form->field($modelPerro, 'tiene_marca_visible')->widget(Select2::className(), [
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
                    <div class="col-sm-8">
                        <?= $form->field($modelPerro, 'marca_visible_detalle')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($modelPerro, 'file')->fileInput()?>
                    </div>
                </div>
                <?php
                    if($tipo_aviso != 3) { //3 = adopcion no necesita ubicar geográficamente ?>


                        <h3 class="text-info"> Ubicación del evento </h3>
                        <p class="text-muted"><i class="fa fa-info-circle"></i> Haga click en el mapa, donde ocurrió el evento</p>
                        <?= $form->field($model, 'latitud')->hiddenInput(['id' => 'lat'])->label(false) ?>
                        <?= $form->field($model, 'longitud')->hiddenInput(['id' => 'long'])->label(false) ?>
                        <div class="row">
                            <div class="col col-lg-8">
                                <div class="panel panel-body panel-info">
                                    <div id='map' style='width:300x; height:300px;'></div>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <?= $form->field($model, 'direccion')->textInput(['readOnly' => true, 'id' => 'address', 'placeholder' => 'Haga click en el mapa']) ?>
                            </div>
                        </div>
                <?php
                    } else {
                        echo $form->field($model, 'direccion')->hiddenInput(['value' => 'Calle Ejemplo 123, Neuquén, Neuquén'])->label(false);
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Publicar' : 'Actualizar aviso', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <div class="panel panel-body panel-info">
        <p class="text-info">Nota: Sus datos de usuario no serán publicados. Sólo se permitirá a usuarios registrados contactarse con usted vía e-mail a través de un formulario en este mismo sitio. Puede verificarlo viendo otras publicaciones.</p>
    </div>
</div>
<script>
    function initMap() {
        var markers = [];
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: {lat: -38.9516784, lng: -68.05918880000002} //Neuquén
        });
        var geocoder = new google.maps.Geocoder();

//        document.getElementById('enviar').addEventListener('click', function() {
//            geocodeAddress(geocoder, map);
//        });

        google.maps.event.addListener(map,  'click', function(event) {
            geocoder.geocode({
                'latLng': event.latLng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        jQuery('#address').val(results[0].formatted_address);
                        jQuery('#lat').val(results[0].geometry.location.lat());
                        jQuery('#long').val(results[0].geometry.location.lng());
                        deleteMarkers();
                        map.setCenter(results[0].geometry.location);
                        var config = {
                            map : map,
                            animation : google.maps.Animation.DROP,
                            icon: 'perro.png',
                            draggable: false,
                            position : results[0].geometry.location,
                            title : jQuery('#address').val(),
                        };
                        addMarker(config);
                    }
                }
            });
        });



        function addMarker(config) {
            var marker = new google.maps.Marker(config);
            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
            setMapOnAll(map);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers(map, markers) {
            clearMarkers();
            markers = [];
        }
    }




</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls&libraries=geometry&callback=initMap" async defer></script>