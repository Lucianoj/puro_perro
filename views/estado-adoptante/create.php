<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoAdoptante */

$this->title = 'Create Estado Adoptante';
$this->params['breadcrumbs'][] = ['label' => 'Estado Adoptantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-adoptante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>