<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Aviso */

//$this->title = 'Crear un nuevo aviso';
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];

if (Yii::$app->getUser()->isGuest)
    Yii::$app->getResponse()->redirect(Url::to(['site/login']));
?>
<div class="aviso-create">


    <?= $this->render('_form', [
        'model' => $model,
        'modelPerro' => $modelPerro,
        'tipo_aviso' => $tipo_aviso,
    ]) ?>

</div>
