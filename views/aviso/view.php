<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\CasosExito;

/* @var $this yii\web\View */
/* @var $model app\models\Aviso */

use app\models\PermisosHelpers;
$es_invitado = Yii::$app->getUser()->isGuest;
$es_autor = !$es_invitado && ($model->created_by == Yii::$app->getUser()->id);
$es_root_o_admin = !$es_invitado && (PermisosHelpers::requerirRol('root') || PermisosHelpers::requerirRol('admin'));

$this->title = ' ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
$casoResuelto = (($modelPerro->estado_perro_id == 3 )||($modelPerro->estado_perro_id == 6 ));
if($casoResuelto)
    $modelCasoExito = CasosExito::findOne(['aviso_id' => $model->id]);

switch($model->tipo_aviso_id) {
    case 1 :{ // 1 = perro perdido
        $tituloBoton = '<i class="fa fa-smile-o"></i> Encontre a '.$modelPerro->nombre.'<i class="fa fa-exclamation" aria-hidden="true"></i><i class="fa fa-exclamation" aria-hidden="true"></i><i class="fa fa-exclamation" aria-hidden="true"></i>';
        break;
    };
    case 2 :{ // 2 = perro encontrado
        $tituloBoton = '<i class="fa fa-smile-o"></i> Encontre al Dueño <i class="fa fa-exclamation" aria-hidden="true"></i><i class="fa fa-exclamation" aria-hidden="true"></i><i class="fa fa-exclamation" aria-hidden="true"></i>';
        break;
    };
    case 3: { // 3 = Perro en adopcion
        $tituloBoton = '<i class="fa fa-smile-o"></i> Encontre Adoptante <i class="fa fa-exclamation" aria-hidden="true"></i><i class="fa fa-exclamation" aria-hidden="true"></i><i class="fa fa-exclamation" aria-hidden="true"></i>';
        break;
    };
    default: {
        break;
    };

}
?>
<div class="aviso-view">
    <?php
        if($casoResuelto) { ?>
            <h1 class="text-center text-success"><i class="fa fa-smile-o"></i><?= Html::encode(' Estamos Felices: "'.$this->title. ' " está resuelto!! ') ?></h1><br>
            <div class="panel panel-body panel-success">
                <div class="row">
                    <div class="col col-lg-6 text-center">
                        <div class="text-center"><img class="img-responsive" alt="<?=$modelPerro->nombre.'-reencuentro'?>" src="<?=isset($modelCasoExito->foto_reencuentro)?$modelCasoExito->foto_reencuentro:'uploads/reencuentro.jpg'?>"></div>
                    </div>
                    <div class="col col-lg-6">
                        <h2 class="text-info text-center">Testimonio</h2>
                        <h3 class="text-primary"><?=isset($modelCasoExito->mensaje)?$modelCasoExito->mensaje:'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod'?></h3>
                    </div>
                </div>

            </div>
    <?php
        } else { ?>

            <h1 class="text-center text-info"><i class="fa fa-bullhorn"></i><?= Html::encode($this->title) ?></h1><br>
            <?php
                if($es_invitado){
                    $tituloBotonLog = '<i class="fa fa-info-circle text-info"></i> Debe ingresar al sitio para contactar al autor';
                    echo Html::a($tituloBotonLog, ['site/login'], ['class' => 'btn btn-md btn-default']);

                }
        }
    ?>
    <p>
    <div class="row">
        <?php
            if (($es_autor || $es_root_o_admin) and !$casoResuelto)
                echo Html::a('Modificar Aviso', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-info']);
        ?>
        <?php
            if (!$es_invitado && !$es_autor)
                echo Html::a('Reportar', ['report', 'id' => $model->id], [
                    'class' => 'btn  btn-lg btn-warning',
                    'data' => [
                        'confirm' => 'Está seguro que desea reportar esta publicación?',
                        'method' => 'post',
                    ],
                ]);
            ?>

        <?php
            if (!$es_invitado && !$es_autor && !$casoResuelto)
                echo Html::a('Contactar al Autor', ['contactar', 'id' => $model->id], [
                    'class' => 'btn   btn-lg btn-success',
                    'data' => [
                    'confirm' => 'Sus datos de usuario serán vistos por el Autor del Aviso',
                    'method' => 'post',
                    ],
                ]);
        ?>
        <?php
            if((!$es_invitado) && $es_autor && (!$casoResuelto)) {
                echo Html::button($tituloBoton, ['value' => Url::to(['casos-exito/create', 'id_aviso' => $model->id, 'id_perro' => $modelPerro->id]), 'title' => $tituloBoton, 'class' => 'showModalButton btn btn-lg btn-success']);
            }
        ?>
    </div>
    </p>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-list"></i> Detalles del Aviso </h4></div>
            <div class="panel panel-body">
            <div class="panel panel-body panel-info">
                <div class="row">
                    <div class="col col-sm-8">
                        <h3 class="text-center text-info"><strong>Datos del Aviso</strong></h3>
                        <?php
                            if($model->tipo_aviso_id != 3) {
                                echo DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'Autor',
                                        'titulo',
                                        'informacion:ntext',
                                        'direccion',
                                        'fechaEventoOrdenada:html:Fecha Suceso',
                                        'createdAtOrdenado:html:Fecha del Aviso',
                                        'updatedAtOrdenado:html:Última Actualización',
                                    ],
                                ]);
                            } else{
                                echo DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'Autor',
                                        'titulo',
                                        'informacion:ntext',
                                        'createdAtOrdenado:html:Fecha del Aviso',
                                        'updatedAtOrdenado:html:Última Actualización',
                                    ],
                                ]);
                            }
                        ?>
                    </div>
                    <div class="col col-sm-4 text-center">
                        <h3 class="text-info"><?= Html::label('Foto de '. $modelPerro->nombre)?></h3>
                        <img  class="img-responsive" src="<?=$modelPerro->foto?>" alt="<?=$modelPerro->nombre?>" width = 300></img>
                    </div>
                </div>
            </div>
            <div class="panel panel-body panel-primary">
                <h3 class="text-center text-info"><strong>Datos del Perro</strong></h3>
                <div class="row">
                    <div class="col col-sm-6">
                        <?= DetailView::widget([
                                'model' => $modelPerro,
                                'attributes' => [
                                    'nombre',
                                    'razaNombre:html:Raza',
                                    'sexoNombre:html:Sexo',
                                    'edad_estimada',
                                    'tipoPeloNombre:html:Estilo Pelo',
                                    'estaEnfermoSiNo:html:Está Enfermo?',
                                    'estadoPerroNombre:html:Situación Actual',
                                    'tamanioNombre:html:Tamaño',
                                    'estadoClinicoNombre:html:Estado clínico',
                                    'estadoClinicoInfo:html:Estado Clínico Info',
                                ],
                            ])?>
                    </div>
                    <div class="col col-sm-6">
                        <?= DetailView::widget([
                            'model' => $modelPerro,
                            'attributes' => [
                                'colorPrimarioNombre:html:Color Principal',
                                'colorSecundarioNombre:html:Color Secundario',
                                'tieneCollarSiNo:html:Tiene Collar',
                                'orejasCortadasSiNo:html:Orejas Cortadas',
                                'colaCortadaSiNo:html:Cola Cortadas',
                                'preniadaSiNo:html:Preñada?',
                                'castradaSiNo:html:Castrada/o',
                                'tieneMarcaVisibleSiNo:html:Marca Visible?',
                                'marca_visible_detalle:html:Detalles',
                                'leFaltanMiembrosSiNo:html:Le Faltan Miembros?',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
                <?php
                    if(!$casoResuelto && ($model->tipo_aviso_id != 3)) { ?>
                        <div class="row">
                            <div class="col col-lg-2"><br>
                            </div>
                            <div class="col col-lg-8"><br>
                                <h3 class="text-center text-info">Ubicación Geográfica</h3>
                                <div class="panel">
                                    <div class="panel panel-body panel-info">
                                        <div id='map' style='width:710px; height:400px;'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-2"><br><br>
                            </div>
                                <input id="lat" type="hidden" value="<?=$model->latitud?>">
                                <input id="long" type="hidden" value="<?=$model->longitud?>">
                        </div>
               <?php }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    $url = \Yii::$app->getUrlManager()->createUrl('aviso/get-data-google-maps');
?>
<script>

    function initMap() {
        var latitud = jQuery('#lat').val();
        var longitud = jQuery('#long').val();
        var ubicacion = new google.maps.LatLng(latitud, longitud);
        var markers = [];
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: ubicacion
        });
        var geocoder = new google.maps.Geocoder();

        var latitud = jQuery('#lat').val();
        var longitud = jQuery('#long').val();
        var ubicacion = new google.maps.LatLng(latitud, longitud);
        var marker = new google.maps.Marker({
            map: map,
            position: ubicacion,
            icon: 'perro.png',
        });

//        document.getElementById('enviar').addEventListener('click', function() {
//            insertarUbicaciones(map, latitud, longitud, markers);
//        });
    }

    function marcarMapa(data, map, markers) {
        var info = $.parseJSON(data);
        var mostrar = "";

        for (var i = 0; i < info.results.length; i++) {
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(info.results[i].geometry.location.lat, info.results[i].geometry.location.lng),
                label: info.results[i].name,
                icon: info.results[i].icon,
            });
            markers.push(marker);

            var j = i + 1;
            mostrar += '<h5 class=\'text-info\'>' + j + ' ) ' + info.results[i].name + '</h5>';
            mostrar += '<h6 class=\'text-muted\'>' + info.results[i].vicinity + '</h6>';
        }
        jQuery('#datos').html(mostrar);
    }

    function insertarUbicaciones(map, lat, lng, markers) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        var type = jQuery('#type').val();
        var radio = jQuery('#radio').val();
        var data = {
            url: 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' + lat + ',' + lng + '&radius=' + radio + '&type=' + type + '&name=cruise&key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls',
        }

        jQuery.ajax({
            type: 'GET',
            data : data,
            url: '<?=$url?>',
            success:  function(data) {
                marcarMapa(data, map, markers);
            },
            error: function(e) {
                console.log('error:' + e.message);
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD5TwT3vXLfYEv9WD-kOcEg7YQLcncsls&callback=initMap" async defer></script>
<?php
    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'size' => 'modal-lg',
        //keeps from closing modal with esc key or by clicking out of the modal.
        //user must click cancel or X to close
        //'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'><div style='text-align:center'></div></div>";
    Modal::end();
?>