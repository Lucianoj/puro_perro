<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <h1><i class="fa fa-heart-o"></i> Puro Perro</h1>

    <p>Hola <?= Html::encode($user->apodo) ?>,</p>

    <p>Ingresa al siguiente link para resetear tu contraseña:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
