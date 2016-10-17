<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PermisosHelpers;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $model app\models\User */

$es_root = (!Yii::$app->user->isGuest && PermisosHelpers::requerirRol('root'));
$this->title = $model->apodo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(!$es_root) {
    Yii::$app->getResponse()->redirect(Url::to(['site/index']));
}
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modificar Datos'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'apodo:html:Nombre',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email',
            'telefono_celular',
            'telefono_fijo',
            'rolNombre:html:Rol',
//            'estadoNombre',
//            'tipo_usuario_id',
//            'created_at',
//            'updated_at',
        ],
    ]) ?>

</div>
