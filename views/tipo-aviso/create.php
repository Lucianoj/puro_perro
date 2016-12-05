<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoAviso */

$this->title = ' Nuevo Tipo Aviso';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-aviso-create">

    <h1 class="text-center"><i class="fa fa-list"></i><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
