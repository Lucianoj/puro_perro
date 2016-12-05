<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CasosExito */

//$this->title = 'Create Casos Exito';
//$this->params['breadcrumbs'][] = ['label' => 'Casos Exitos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casos-exito-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPerro' => $modelPerro,
        'modelAviso' => $modelAviso,
    ]) ?>

</div>
