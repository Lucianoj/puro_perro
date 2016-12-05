<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CasosExito */

$this->title = 'Update Casos Exito: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Casos Exitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="casos-exito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
//        'modelPerro' => $modelPerro,
//        'modelAviso' => $modelAviso,
    ]) ?>

</div>
