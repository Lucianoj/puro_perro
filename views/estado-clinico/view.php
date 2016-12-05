<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoClinico */

$this->title = 'Estado: ' .$model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estado Clínicos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-clinico-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="panel panel-info">
        <div class="panel-heading"><h4 class="text-default"><i class="fa fa-list-alt"></i> Detalles del Estado</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nombre',
                    'descripcion',
                ],
            ]) ?>
        </div>
    </div>

</div>
