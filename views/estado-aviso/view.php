<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoAviso */

$this->title = 'Estado Aviso: '. $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estado Avisos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-aviso-view">

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
                    'valor',
                ],
            ]) ?>
        </div>
    </div>
</div>
