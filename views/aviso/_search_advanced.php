<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 29/11/16
 * Time: 17:10
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\PermisosHelpers;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TipoAviso;
use app\models\EstadoAviso;
use app\models\EstadoPerro;
use app\models\EstadoClinico;
use app\models\Color;
use app\models\Raza;
use yii\helpers\Url;
use app\models\Tamanio;
use app\models\TipoPelo;
use app\models\Sexo;
use kartik\date\DatePicker;

$es_root = !Yii::$app->getUser()->isGuest && PermisosHelpers::requerirMinimoRol('root');
$es_admin = !Yii::$app->getUser()->isGuest && PermisosHelpers::requerirMinimoRol('admin');
$sino =  [['id' => '0', 'nombre' => 'No'], ['id' => '1', 'nombre' => 'Sí'],['id' => '2', 'nombre' => 'No lo sé']];
$radio =  [[1 => '1000', 'nombre' => '1km', 'id' => '1000'],
           [2 => '3000', 'nombre' => '3km', 'id' => '3000'],
           [3 => '5000', 'nombre' => '5km', 'id' => '5000'],
           [4 => '10000', 'nombre' => '10km', 'id' => '10000'],
           [5 => '50000', 'nombre' => '50km', 'id' => '50000'],
           [6 => '100000', 'nombre' => '100km', 'id' => '100000']];
$título = '';
//$es_autor =  !Yii::$app->getUser()->isGuest && (!$searchModel->isNewRecord && (Yii::$app->getUser()->id == $searchModel->created_by));

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AvisoSearchAdvanced */
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
<div class="aviso-search-advanced">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class='panel panel-default'>
        <div class='panel-heading'><h3 class='text-primary'> Complete los datos de la búsqueda</h3><h4 class="text-muted"><i class='fa fa-info-circle'></i> Puede dejar en blanco los campos que no conozca.</h4></div>
        <div class='panel-body'>
            <h3 class="text-info"> Datos Referidos al Aviso </h3>
            <div class="row">
                <?= $form->field($searchModel, 'busqueda_avanzada')->hiddenInput(['value' => true])->label(false) ?>
                <div class="col-sm-4">
                <?php
                    echo $form->field($searchModel, 'tipo_aviso_id')->widget(Select2::className(), [
                        'data' => ArrayHelper::map(TipoAviso::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ]
                    ])->label('Tipo de Aviso');

                    if(false) {//$es_root || $es_admin) {
                        echo  $form->field($searchModel, 'estado_aviso_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(EstadoAviso::find()->addOrderBy('nombre')->all(), 'id', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccione ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ])->label('Estado del Aviso, solo para Administrador');
                    }
                ?>
                </div>
<!--            </div>-->
<!--                <div class="row">-->
                        <div class="col-sm-4">
                            <?= $form->field($searchModel, 'titulo')->textInput(['maxlength' => true, 'placeholder' => 'Palabra clave para título']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                            if(true){ //$searchModel->isNewRecord) {
                                echo $form->field($searchModel, 'fecha_evento')->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => date('d/m/Y')],
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'dd/mm/yyyy',
                                    ]
                                ])->label('Cuándo Sucedió?');
                            } else {
                                echo $form->field($searchModel, 'fecha_evento')->widget(DatePicker::classname(), [
                                    'options' => ['value' => ordenarFechaParaMostrar($searchModel->fecha_evento)],
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'dd/mm/yyyy',
                                    ]
                                ])->label('Cuándo Sucedió?');
                            }
                            ?>
                        </div>
                </div>
                <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($searchModel, 'informacion')->textInput(['placeholder' => 'Palabra clave para Información']) ?>
                        </div>
                </div>

                <h3 class="text-info"> Datos Referidos al Perro </h3>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($searchModel, 'p_nombre')->textInput(['maxlength' => true, 'placeholder' => 'Ej: "Firulais"']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($searchModel, 'p_raza_id')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_sexo_id')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_esta_enfermo')->widget(Select2::className(), [
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
                        <?= $form->field($searchModel, 'p_estado_clinico_id')->widget(Select2::className(), [
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
                        <?= $form->field($searchModel, 'p_color_primario')->widget(Select2::className(), [
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
                        <?= $form->field($searchModel, 'p_color_secundario')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_tiene_collar')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_tamanio_id')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_castrada')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_preniada')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_cola_cortada')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_orejas_cortadas')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_le_faltan_miembros')->widget(Select2::className(), [
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
                            echo  $form->field($searchModel, 'p_tipo_pelo_id')->widget(Select2::className(), [
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
                        <?= $form->field($searchModel, 'p_edad_estimada')->textInput(['maxlength' => true])?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                            echo  $form->field($searchModel, 'p_tiene_marca_visible')->widget(Select2::className(), [
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
                        <?= $form->field($searchModel, 'p_marca_visible_detalle')->textInput(['maxlength' => true,  'placeholder' => 'Para aumentar posibilidades, utilize una palabra, por ej: "Cicatríz"']) ?>
                    </div>
                </div>
                <h3 class="text-primary"> Ubicación del evento </h3>
                <p class="text-muted"><i class="fa fa-info-circle"></i> Haga click en el mapa, donde ocurrió el evento</p>
                <div class="row">
                    <div class="col col-lg-8">
                        <div class="panel panel-body panel-info">
                            <div id='map-modal' style='width:510px; height:300px;'></div>
                        </div>
                    </div>
                    <div class="col col-lg-4">
                        <?= $form->field($searchModel, 'a_radio')->widget(Select2::className(), [
                                    'data' =>  ArrayHelper::map($radio, 'id', 'nombre'),
                                    'language' => 'es',
                                    'value' => 0,
                                    'options' => ['placeholder' => 'Seleccione ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ]
                            ])
                        ?>
                        <?= $form->field($searchModel, 'direccion')->textInput(['readOnly' => true, 'maxlength' => true, 'id' => 'address', 'placeholder' => 'Se completa automáticamente']) ?>
                        <?= $form->field($searchModel, 'a_latitud')->textInput(['readOnly' => true,'id' => 'lat', 'placeholder' => 'Se completa automáticamente'])->label('Latitud') ?>
                        <?= $form->field($searchModel, 'a_longitud')->textInput(['readOnly' => true, 'id' => 'long', 'placeholder' => 'Se completa automáticamente'])->label('Longitud') ?>
                    </div>
                </div>
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-md btn-primary'])?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>
    function initMap2() {
        var markers = [];
        var map = new google.maps.Map(document.getElementById('map-modal'), {
            zoom: 13,
            center: {lat: -38.9516784, lng: -68.05918880000002} //Neuquén
        });
        var geocoder = new google.maps.Geocoder();

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls&libraries=geometry&callback=initMap2" async defer></script>
