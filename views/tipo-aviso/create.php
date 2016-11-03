<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoAviso */

$this->title = Yii::t('app', 'Create Tipo Aviso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Avisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-aviso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
