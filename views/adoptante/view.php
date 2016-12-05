<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\PermisosHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Adoptante */

$modelUser = User::findOne(['id' => $model->user_id]);
$this->title = 'Características del adoptante: ' .$modelUser->apodo;
$this->params['breadcrumbs'][] = ['label' => 'Adoptantes', 'url' => ['index']];
$es_root_o_admin = !Yii::$app->user->isGuest && (PermisosHelpers::requerirRol('admin') || PermisosHelpers::requerirRol('root'));
?>
<div class="adoptante-view">

    <h1 class="text-center text-info"><?= Html::encode($this->title) ?></h1><br>

    <div class="panel panel-default">
        <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-list"></i> Detalles del Adoptante </h4></div>
        <div class="panel-body">
            <?php
                if (!$es_root_o_admin) {
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'userApodo:html:Apodo',
//                            'estadoAdoptanteNombre:html:Estado',
                            'tieneOtrosPerrosSiNo:html:Tiene Otros Perros',
                            'tieneNiniosSiNo:html:Tiene Niños?',
                            'tienePatioCerradoSiNo:html:Tiene Patio Cerrado?',
                            'tieneGatosSiNo:html:Tiene Gato?',
                            'dejaCasaSolaMuchasHorasSiNo:html:Deja la casa sola muchas horas?',
                            'puedeAtenderMascotaEnfermaSiNo:html:Puede atender mascota enferma?',
                            'aceptaVisitasDeControlSiNo:html:Acepta visitas periódicas de control?',
                            'comentarios:ntext',
                        ],
                    ]);
                } else {
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'userApodo:html:Apodo',
                            'estadoAdoptanteNombre:html:Estado',
                            'tieneOtrosPerrosSiNo:html:Tiene Otros Perros',
                            'tieneNiniosSiNo:html:Tiene Niños?',
                            'tienePatioCerradoSiNo:html:Tiene Patio Cerrado?',
                            'tieneGatosSiNo:html:Tiene Gato?',
                            'dejaCasaSolaMuchasHorasSiNo:html:Deja la casa sola muchas horas?',
                            'puedeAtenderMascotaEnfermaSiNo:html:Puede atender mascota enferma?',
                            'aceptaVisitasDeControlSiNo:html:Acepta visitas periódicas de control?',
                            'comentarios:ntext',
                            'nota_admin',
                        ],
                    ]);
                }
            ?>

        </div>
    </div>
</div>
