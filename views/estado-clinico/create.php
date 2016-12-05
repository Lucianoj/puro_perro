<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoClinico */

$this->title = 'Nuevo Estado Clinico';
$this->params['breadcrumbs'][] = ['label' => 'Estado Clinicos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-clinico-create">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
