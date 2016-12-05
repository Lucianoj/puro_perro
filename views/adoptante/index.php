<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\PermisosHelpers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AdoptanteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' Listado de Adoptantes';
$this->params['breadcrumbs'][] = $this->title;

$es_root_or_admin = !Yii::$app->getUser()->isGuest && (PermisosHelpers::requerirRol('root') or PermisosHelpers::requerirRol('admin'));

if (Yii::$app->getUser()->isGuest)
    Yii::$app->getResponse()->redirect(Url::to(['site/login']));
else if(!$es_root_or_admin)
    Yii::$app->getResponse()->redirect(Url::to(['site/index']));

?>
<div class="adoptante-index">

    <h1 class="text-center text-info"><i class="fa fa-heart"></i><?= Html::encode($this->title) ?></h1><br>

    <div class="panel panel-primary">
        <div class="panel-heading"><h4 class="text-default"><i class="fa fa-list"></i> Listado de Adoptantes!! </h4></div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'user.apodo',
                        'label' => 'Usuario',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->userApodo,  ['user/view', 'id' => $model->user_id]);
                        },
                    ],
                    [
                        'attribute' => 'estado.nombre',
                        'label' => 'Estado',
                        'format' => 'raw',
                        'value' => function ($model) {
                            switch ($model->estado_adoptante_id){
                                case 1:{ // 1 = nuevo
                                   return '<div class="text-info">'.$model->estadoAdoptanteNombre.'</div>';
                                };
                                case 2: { // 2 = aceptado
                                   return '<div class="text-success">'.$model->estadoAdoptanteNombre.'</div>';
                                };
                                case 3:{ // 3 = rechazado
                                   return '<div class="text-danger">'.$model->estadoAdoptanteNombre.'</div>';
                                }

                            }
                        },
                    ],
                     'comentarios:ntext',
                     'nota_admin',
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
                ],
            ]); ?>
        </div>
    </div>
</div>
