<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadoAviso */

$this->title = Yii::t('app', 'Crear nuevo estado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estado Avisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-aviso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
