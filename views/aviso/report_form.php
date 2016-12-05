<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 07/11/16
 * Time: 08:38
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ReportFormForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Reportar Publicación';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1><br>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Gracias por ayudarnos a hacer de Puro Perro un sitio mejor.
        </div>

    <?php endif; ?>
    <h3>
    <p class="text-info">
        Título de Publicación: <?= $modelAviso->titulo ?>
    </p>
    <p class="text-primary">
        Nombre del Perro: <?= $modelPerro->nombre ?>
    <p class="text-muted">
        Usuario que reporta: <?= $modelUser->apodo ?> (no se publica)
    </p>
    </h3>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-info-circle"></i> Complete los datos del Reporte</h4></div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->getUser()->id])->label(false) ?>

                <?= $form->field($model, 'motivo')->textInput(['placeholder' => 'Intente explicar el motivo brevemente']) ?>

                <?= $form->field($model, 'informacion')->textArea(['rows' => 6, 'placeholder' => 'Aquí puede explayarse para justificar el motivo del reporte.']) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar Reporte', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>