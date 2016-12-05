<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PermisosHelpers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ' Usuarios');
$this->params['breadcrumbs'][] = $this->title;

$es_invitado = Yii::$app->user->isGuest;
$es_root_o_admin = !Yii::$app->user->isGuest && (PermisosHelpers::requerirRol('admin') || PermisosHelpers::requerirRol('root'));
if($es_invitado) {
    Yii::$app->getResponse()->redirect(Url::to(['site/login']));
} else if($es_root_o_admin) {
?>

<div class="user-index">

    <h1 class="text-center text-info"><i class="fa fa-users"></i><?= Html::encode($this->title) ?></h1><br>
    <div class="panel panel-primary">
        <div class="panel-heading"><h4 class="text-default"><i class="fa fa-list"></i> Listado de Usuarios (Un gran poder implica una gran responsabilidad <i class="fa fa-exclamation"></i><i class="fa fa-exclamation"></i>)</h4></div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'apodo',
                    'nombre',
                    'apellido',
                    'telefono_celular',
                    'email:email',
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php
} else {
?>
    <h1 class="text-danger text-center"> Usted no tiene autorización para estar aquí.</h1>
<?php
}