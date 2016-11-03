<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAviso */

$this->title = 'Modificar Tipo Aviso: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
?>
<div class="tipo-aviso-update">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
