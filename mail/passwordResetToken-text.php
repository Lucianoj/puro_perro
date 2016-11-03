<?php

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hola <?= $user->apodo ?>,

Ingrese al siguiente link para resetear su contraseña:

<?= $resetLink ?>
