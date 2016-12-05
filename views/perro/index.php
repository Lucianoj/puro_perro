<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PerroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Perro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'estado_perro_id',
            'estado_clinico_id',
            'color_primario',
            // 'color_secundario',
            // 'raza_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
