<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 07/11/16
 * Time: 15:16
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contactar a Autor de Pubicación';
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
        </p>
    </h3>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="text-primary"><i class="fa fa-info-circle"></i> Complete los datos a continuación</h4></div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'user_id')->hiddenInput(['value' => $modelAviso->created_by])->label(false) ?>

                <?= $form->field($model, 'motivo')->textInput(['placeholder' => 'Título del mensaje']) ?>

                <?= $form->field($model, 'mensaje')->textArea(['rows' => 6, 'placeholder' => 'Aquí puedes desarrollar el mensaje. Tu nombre, teléfono celular y e-mail formarán parte del mensaje aunque no los incluyas.']) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar Mensaje', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>