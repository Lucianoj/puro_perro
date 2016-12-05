<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 06/11/16
 * Time: 14:17
 */

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Aviso;
use app\models\EstadoAviso;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AvisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

switch ($estado) {
    case 0:{
        $panel_type = GridView::TYPE_DEFAULT;
        $text = 'text-default';
        $this->title = Yii::t('app', ' Todos los Avisos');
        break;
    }
    case 1:{
        $panel_type = GridView::TYPE_SUCCESS;
        $text = 'text-success';
        $this->title = Yii::t('app', ' Avisos Abiertos');
        break;
    }
    case 2:{
        $panel_type = GridView::TYPE_INFO;
        $text = 'text-info';
        $this->title = Yii::t('app', ' Avisos Cerrados');
        break;
    }
    case 3:{
        $panel_type = GridView::TYPE_WARNING;
        $text = 'text-warning';
        $this->title = Yii::t('app', ' Avisos Reportados');
        break;
    }
    case 4:{
        $panel_type = GridView::TYPE_DANGER;
        $text = 'text-danger';
        $this->title = Yii::t('app', ' Avisos Eliminados');
        break;
    }
}

?>
<div class="aviso-index-user">
    <h1 class="text-center <?=$text?>"><i class="fa fa-bullhorn"></i><?= Html::encode($this->title) ?></h1><br>
    <?php

    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'tipo.nombre',
            'label' => 'Tipo',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->tipoAvisonombre, '../tipoAviso/view?id='.$model->tipo_aviso_id);
            },
        ],
        [
            'attribute' => 'titulo',
            'label' => 'Título',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->titulo, '../aviso/view?id='.$model->id);
            },
        ],
        [
            'attribute' => 'perro.nombre',
            'label' => 'Perro',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->perroNombre, '../aviso/view?id='.$model->perroNombre);
            },
        ],
        [
            'attribute' => 'user.apodo',
            'label' => 'Autor',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::encode($model->autor, '../aviso/view?id='.$model->created_by);
            },
        ],
        [
            'attribute' => 'estado.nombre',
            'label' => 'Estado',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                return Html::encode($model->estadoAvisoNombre, '../estado-aviso/view?id='.$model->estado_aviso_id);
            },
        ],
        [
            'label' => 'Fecha',
            'attribute' => 'created_at',
            'format' => ['date', 'php:d-m-Y'],
        ],
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
    ];

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'bootstrap' =>true,
        'pjax' => true,
        'rowOptions' => function ($model) {
            switch ($model->estado_aviso_id) {
                case 1: {
                    return ['class' => 'text-success'];
                    break;
                }
                case 2: {
                    return ['class' => 'text-info'];
                    break;
                }
                case 3: {
                    return ['class' => 'text-warning'];
                    break;
                }
                case 4: {
                    return ['class' => 'text-danger'];
                    break;
                }
                default: {
                    return ['class' => 'text-default'];
                    break;
                }
            }
        },
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => $panel_type,
            'heading' => '<h3 class = "panel-title"><i class="fa fa-info-circle"></i> Listado de Avisos para Administrador</h3>',
        ],
        'export' => [
            'label' => 'Página',
            'heading' => '<li class = "dropdown-header"> Exportar esta página </li>',
        ],
    ]);
    ?>
</div>