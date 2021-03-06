<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EstadoAvisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estados de Aviso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-aviso-index">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <div class="col col-lg-2">
    </div>
    <div class="col col-lg-8">
        <div class="panel panel-info">
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'nombre',
                        'valor',
                        ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
                    ],
                ]); ?>
            </div>
            <p class="text-center">
                <?= Html::a('Nuevo Estado de Aviso', ['create'], ['class' => 'btn btn-success']) ?>
            </p><br>
        </div>
        <div class="col col-lg-2">
        </div>
    </div>
</div>
