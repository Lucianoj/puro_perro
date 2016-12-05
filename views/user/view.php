<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PermisosHelpers;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $model app\models\User */

$es_root = (!Yii::$app->user->isGuest && PermisosHelpers::requerirRol('root'));
$es_admin = (!Yii::$app->user->isGuest && PermisosHelpers::requerirRol('admin'));
$es_user = !Yii::$app->user->isGuest && (Yii::$app->user->id == $model->id);
$this->title = ' '.$model->apodo;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
if(!($es_root || $es_user || $es_admin) ) {
    Yii::$app->getResponse()->redirect(Url::to(['site/index']));
}
?>
<div class="user-view">

    <h1 class="text-center text-primary"><i class="fa fa-user"></i><?= Html::encode($this->title) ?></h1>

    <p>

        <?php
            if ($es_admin || $es_root || $es_user) {
                echo Html::a(Yii::t('app', 'Modificar datos de perfil'), ['update', 'id' => $model->id, 'nuevo' => false], ['class' => 'btn btn-primary']);
            }
        ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-list"></i> Detalles del Usuario </h4></div>
        <div class="panel-body">
            <?php
                if($es_admin || $es_root) {
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'apodo',
                            'nombre',
                            'apellido',
                            'domicilio',
                            'email',
                            'telefono_celular',
                            'telefono_fijo',
                            'rolNombre:html:Rol',
                            'deseaAdoptarSiNo:html:Desea Adoptar',
                            'ofreceTransitoSiNo:html:Ofrece Tránsito'
                        ],
                    ]);
                } else {
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'apodo',
                            'nombre',
                            'apellido',
                            'domicilio',
                            'email',
                            'telefono_celular',
                            'telefono_fijo',
                            'deseaAdoptarSiNo:html:Desea Adoptar',
                            'ofreceTransitoSiNo:html:Ofrece Tránsito'
                        ],
                    ]);
                }
            ?>
        </div>
    </div>
    <?php
        if($es_adoptante == 1) {?>
            <div class="panel panel-success">
                <div class="panel-heading"><h4 class="text-default"><i class="fa fa-heart-o"></i> Datos como Adoptante</h4></div>
                <div class="panel-body">

                    <?php
                    if($completo_planilla_adopcion == 1) {
                        if($es_admin || $es_root) {
                                echo DetailView::widget([
                                    'model' => $modelAdoptante,
                                    'attributes' => [
                                        'estadoAdoptanteNombre:html:Estado',
                                        'tieneOtrosPerrosSiNo:html:Tiene otros perros?',
                                        'tieneNiniosSiNo:html:Tiene niños?',
                                        'tienePatioCerradoSiNo:html:Tiene patio cerrado?',
                                        'tieneGatosSiNo:html:Tiene gatos?',
                                        'dejaCasaSolaMuchasHorasSiNo:html:Deja la casa sola por muchas horas?',
                                        'puedeAtenderMascotaEnfermaSiNo:html:Puede atender una mascota enferma?',
                                        'aceptaVisitasDeControlSiNo:html:Acepta visitas domiciliarias de control?',
                                        'comentarios:ntext',
                                    ],
                                ]);
                                ?><div class="text-center"><?= Html::a(Yii::t('app', 'Administrar Formulario Adoptante'), ['adoptante/update', 'user_id' => $model->id], ['class' => 'btn btn-primary'])?></div><br><br><?php
                        } else {
                            echo DetailView::widget([
                                'model' => $modelAdoptante,
                                'attributes' => [
                                    'tieneOtrosPerrosSiNo:html:Tiene otros perros?',
                                    'tieneNiniosSiNo:html:Tiene niños?',
                                    'tienePatioCerradoSiNo:html:Tiene patio cerrado?',
                                    'tieneGatosSiNo:html:Tiene gatos?',
                                    'dejaCasaSolaMuchasHorasSiNo:html:Deja la casa sola por muchas horas?',
                                    'puedeAtenderMascotaEnfermaSiNo:html:Puede atender una mascota enferma?',
                                    'aceptaVisitasDeControlSiNo:html:Acepta visitas domiciliarias de control?',
                                    'comentarios:ntext',
                                ],
                            ]);
                            ?><?= Html::a(Yii::t('app', 'Modificar datos en formulario de adoptante'), ['adoptante/update', 'user_id' => $model->id], ['class' => 'btn btn-primary'])?><br><br><?php
                        }
                    } else if($es_admin || $es_root){?>

                    <?php
                    } else {?>
                        <h3 class="text-center text-info"><i class="fa fa-info-o"></i><?= Html::encode('Aún no ha completado el formulario de Adoptante') ?></h3>
                        <div class="text-center"><?= Html::a(Yii::t('app', 'Completar Formulario Adoptante'), ['adoptante/create', 'user_id' => $model->id], ['class' => 'btn btn-primary'])?></div><br><br>
                <?php
                    }?>
                </div>
            </div>
            <?php
                }
            ?>
</div>
