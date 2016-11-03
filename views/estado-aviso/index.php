<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EstadoAviso */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Estado Avisos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-aviso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear un nuevo estado'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'valor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
