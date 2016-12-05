<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aviso */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->id]];
?>
<div class="aviso-update">

    <h1 class="text-center"><i class="fa fa-bullhorn"></i><?= Html::encode(' Modificar: '.$this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPerro' => $modelPerro,
        'tipo_aviso' => $tipo_aviso,
    ]) ?>

</div>
