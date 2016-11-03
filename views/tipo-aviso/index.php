<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TipoAvisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Aviso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-aviso-index">
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

                            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
                        ],
                    ]); ?>
                </div>
            <p class="text-center">
                <?= Html::a('Nuevo Tipo de Aviso', ['create'], ['class' => 'btn btn-success']) ?>
            </p><br>
            </div>
        <div class="col col-lg-2">
        </div>
    </div>
</div>
