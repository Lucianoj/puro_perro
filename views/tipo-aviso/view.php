<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAviso */

$this->title = '<div class = "text-info"> ' .$model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Avisos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-aviso-view">
    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="panel panel-info">
        <div class="panel-body">
            <h2 class="text-center">Nombre del Tipo de Aviso: <?= $this->title ?></h2><br>
        </div>
    </div>
</div>
