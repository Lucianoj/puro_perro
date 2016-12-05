<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adoptante */

$this->title = ' Actualizar Datos de Adoptante';
//$this->params['breadcrumbs'][] = ['label' => 'Adoptantes', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adoptante-update">

    <h1 class="text-center text-primary"><i class="fa fa-heart-o"></i><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
        'user_id' => $user_id,
        'modelUser' => $modelUser,
    ]) ?>

</div>
