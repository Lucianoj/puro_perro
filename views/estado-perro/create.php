<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoPerro */

$this->title = 'Create Estado Perro';
$this->params['breadcrumbs'][] = ['label' => 'Estado Perros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-perro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
