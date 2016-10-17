<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Perro */

$this->title = 'Create Perro';
$this->params['breadcrumbs'][] = ['label' => 'Perros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
