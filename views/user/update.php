<?php

use yii\helpers\Html;
use app\models\PermisosHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$es_root = (!Yii::$app->user->isGuest && PermisosHelpers::requerirRol('root'));
if($es_root) {
    $titulo1 = 'Modificar datos de ';
    $titulo2 = $model->apodo;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $titulo2, 'url' => ['view', 'id' => $model->id]];
//    $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
    ?>
    <div class="user-update">

        <h1 class="text-center"><?= $titulo1 ?><div class="text-info"> <?= $titulo2 ?></div></h1> <br>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
<?php
} else if($model->id == Yii::$app->user->id){
    $titulo1 = 'Modificar mis datos ';
    $titulo2 = $model->apodo;
    $this->params['breadcrumbs'][] = ['label' => $titulo2, 'url' => ['view', 'id' => $model->id]];
    ?>
    <div class="user-update">

        <h1 class="text-center"><?= $titulo1 ?></h1><br>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
 <div class="user-update">
<?php } else { ?>
        <h1 class="text-center text-info"><?= $titulo2 ?></div></h1> <br>
        <h1 class="text-center text-danger"><?= Html::encode('Usted no tiene autorización para editar usuarios') ?></h1>


    </div>
    <?php
    }