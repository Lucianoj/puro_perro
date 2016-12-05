<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Perro;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AvisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

switch ($tipo) {
    case 0:{
        if($id != 0)
            $this->title = Yii::t('app', ' Mis Avisos');
        else
            $this->title = Yii::t('app', ' Todos los Avisos');
        break;
    }
    case 1:{
        $this->title = Yii::t('app', ' Avisos de Perros Perdidos');
        break;
    }
    case 2:{
        $this->title = Yii::t('app', ' Avisos de Perros Encontrados');
        break;
    }
    case 3:{
        $this->title = Yii::t('app', ' Avisos de Perros en Adopción');
        break;
    }
}
//
?>
    <div class="row">
<!--        <div class="col-lg-2 col-md-2 col-sm-2 text-center">-->
<!--        </div>-->
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
<!--        <div class="panel panel-info">-->
            <?= $this->render('_search', ['model' => $searchModel]); ?>
            <?= Html::button('<i class="fa fa-search-plus"></i> Búsqueda Avanzada', ['value' => Url::to(['aviso/busqueda']), 'title' => 'Búsqueda Avanzada', 'class' => 'showModalButton btn btn-md btn-info'])?>
<!--        </div>-->
        </div>
    </div>
<h1 class="text-center text-info"><i class="fa fa-bullhorn"></i><?= Html::encode($this->title) ?></h1><br><br>
<br><br>
<div class="aviso-index">

    <p>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 text-center">
               <?= Html::a(Yii::t('app', 'Perdí mi Perro'), ['create', 'tipo_aviso' => 1], ['class' => 'btn btn-lg btn-warning']);?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 text-center">
               <?= Html::a(Yii::t('app', 'Encontré un Perro'), ['create', 'tipo_aviso' => 2], ['class' => 'btn btn-lg btn-primary']);?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 text-center">
               <?= Html::a(Yii::t('app', 'Ofrezco Perro en Adopción'), ['create', 'tipo_aviso' => 3], ['class' => 'btn btn-lg btn-info']);?>
            </div>
        </div>
    </p>
    <?= Yii::$app->getUser()->isGuest? '<h4 class="text-center text-info"><i class="fa fa-info-circle"></i>'.Html::encode(' Debe loguearse o darse de alta para publicar').'</h4>':'' ?>
    <br>
    <div class="panel panel-primary">
        <div class="row">
            <div class="panel-body">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView'=>'_view',
                        ]);
                    ?>
                </div>
                <div class="col col-lg-12">
                    <hr class="text-info">
                    <h2 class="text-center text-info"><i class="fa fa-map-marker"></i> Geolocalización de eventos</h2>
                    <div class="panel panel-body panel-info">
                        <div id='map' style='width:700x; height:500px;'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'options' => [
                'id' => 'kartik-modal',
                'tabindex' => false,
            ],
//            'id' => 'modal',
            'size' => 'modal-lg',
        //keeps from closing modal with esc key or by clicking out of the modal.
            //user must click cancel or X to close
            //'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
        ]);
        echo "<div id='modalContent'><div style='text-align:center'></div></div>";
    Modal::end();

?>
<?php
$ubicaciones = [];
$models = $dataProvider->getModels();
$candidad = 0;
foreach ($models as $model){
    $modelPerro = Perro::findOne(['id' => $model->perro_id]);
    ?>
    <input id="<?='nombre_perro_'.$candidad?>" type="hidden" value = "<?=$model->perroNombre?>">
    <input id="<?='titulo_'.$candidad?>" type="hidden" value = "<?=$model->titulo?>">
    <input id="<?='info_'.$candidad?>" type="hidden" value = "<?=substr($model->informacion, 0, 100)?>">
    <input id="<?='url_'.$candidad?>" type="hidden" value = "<?=Url::to(['aviso/view', 'id' => $model->id])?>">
    <input id="<?='latitud_'.$candidad?>" type="hidden" value = "<?=$model->latitud?>">
    <input id="<?='longitud_'.$candidad?>" type="hidden" value = "<?=$model->longitud?>">
    <input id="<?='foto_'.$candidad?>" type="hidden" value = "<?=$modelPerro->foto?>">
    <input id="<?='tipo_aviso_'.$candidad?>" type="hidden" value = "<?=$model->tipo_aviso_id?>">
<?php
    $candidad += 1;
} ?>
<input id="cantidad" type="hidden" value = "<?=$candidad?>">

<script>
    function initMap() {
        var markers = [];
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: {lat: -38.9516784, lng: -68.05918880000002} //Neuquén
        });
        var geocoder = new google.maps.Geocoder();

        var cantidad = jQuery('#cantidad').val();

        for(var i = 0; i< cantidad; i++) {
            if(jQuery("#tipo_aviso_"+i).val() == 1){
                var icono = 'perro_perdido.png'
            } else {
                var icono = 'perro_encontrado.png'
            }
            var contentString = '<div id="content'+i+'">'+
                                    '<div id="siteNotice'+i+'">'+
                                        '<div class="panel panel-info panel-body">'+
                                            '<div class="panel-heading"><h4 class="text-default"><i class="fa fa-list"></i>'+jQuery('#titulo_'+i).val()+'</h4>'+
//                                                '<h4 class="text-info" id="firstHeading" class="firstHeading">'+jQuery('#titulo_'+i).val()+'</h4>'+
                                            '</div>'+
                                            '<h5 id="secodHeading" class="secondHeading">Nombre: '+jQuery('#nombre_perro_'+i).val()+'</h5>'+
                                            '<div id="bodyContent">'+
                                                '<p>'+jQuery('#info_'+i).val()+'...</p>'+
                                                '<div class="row text-center ">'+
                                                    '<div class="col col-lg-2">'+
                                                    '</div>'+
                                                    '<div class="col col-lg-8">'+
                                                        '<div class="panel panel-primary panel-body">'+
                                                            '<center><img class="img-responsive" width = 100% src="'+jQuery("#foto_"+i).val()+'"></center>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="col col-lg-2">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<h2 class="text-center"><a class="btn btn-default" href="'+jQuery("#url_"+i).val()+'">Ver Aviso</a></h2>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';

            var config = {
                map : map,
                draggable: false,
                position : new google.maps.LatLng(jQuery('#latitud_'+i).val(), jQuery('#longitud_'+i).val()),
                title : jQuery('#titulo_'+i).val(),
                icon: icono,
            };

            addMarker(config, contentString);
        }

//        google.maps.event.addListener(map,  'click', function(event) {
//            geocoder.geocode({
//                'latLng': event.latLng
//            }, function(results, status) {
//                if (status == google.maps.GeocoderStatus.OK) {
//                    if (results[0]) {
//                        jQuery('#address').val(results[0].formatted_address);
//                        jQuery('#lat').val(results[0].geometry.location.lat());
//                        jQuery('#long').val(results[0].geometry.location.lng());
//                        deleteMarkers();
//                        map.setCenter(results[0].geometry.location);
//                        var config = {
//                            map : map,
//                            animation : google.maps.Animation.DROP,
//                            draggable: false,
//                            position : results[0].geometry.location,
//                            title : jQuery('#address').val(),
//                        };
//                        addMarker(config);
//                    }
//                }
//            });
//        });



        function addMarker(config, contentString) {
            var marker = new google.maps.Marker(config);

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

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
