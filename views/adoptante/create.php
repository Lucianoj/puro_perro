<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Adoptante */

$this->title = ' Formulario de Adoptante';
//$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adoptante-create">

    <h1 class="text-center text-primary"><i class="fa fa-heart-o"></i><?= Html::encode($this->title) ?></h1><br>

    <?= $this->render('_form', [
        'model' => $model,
        'user_id' => $user_id,
        'modelUser' => $modelUser,
    ]) ?>

</div>
