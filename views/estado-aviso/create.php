<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoAviso */

$this->title = 'Nuevo Estado de Aviso';
$this->params['breadcrumbs'][] = ['label' => 'Estado Avisos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-aviso-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
