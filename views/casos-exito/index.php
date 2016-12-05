<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Aviso;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CasosExitoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' Finales Felices!!';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casos-exito-index">

    <h1 class="text-center text-info"><i class="fa fa-smile-o"></i><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-success">
        <div class="panel-heading"><h4 class="text-default"><i class="fa fa-list"></i> Listado Feliz!! </h4></div>
        <div class="panel panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'foto_reencuentro',
                            'label' => 'Instantanea',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::img($model->foto_reencuentro, ['class' => 'img-responsive', 'width' => 100]);
                            },
                        ],
                        'aviso.titulo:html:Título Aviso',
                        'perro.nombre:html:Nombre Perro',
                        'mensaje:ntext',
                        [
                            'attribute' => 'aviso.titulo',
                            'label' => 'Link',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a(Html::encode('Ver Aviso'), ['aviso/view', 'id' => $model->aviso_id]);
                            },
                        ],
                    ],
                ]); ?>
        </div>
    </div>
</div>