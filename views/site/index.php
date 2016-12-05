<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\PermisosHelpers;
use yii\widgets\ListView;


$es_invitado = Yii::$app->user->isGuest;
$this->title = 'Puro Perro';
?>
<div class="site-index">


    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="text-center">
                <div class="row">
                    <div class="col-lg-12 text-center text-primary">
                        <h3><i class="fa fa-bullhorn"></i> Publicar Avisos</h3><br>

<!--                        <p>Quiero publicar un aviso sobre un perro</p>-->


                    <div class="col-lg-4 text-center">
                        <?= Html::a('Perdí mi Perro &raquo;', ['aviso/create', 'tipo_aviso' => 1], ['class' => 'btn btn-warning btn-lg']) ?>
                    </div>
                    <div class="col-lg-4 text-center">
                        <?= Html::a('Encontré un Perro &raquo;', ['aviso/create', 'tipo_aviso' => 2], ['class' => 'btn btn-primary btn-lg']) ?>
                    </div>
                    <div class="col-lg-4 text-center">
                        <?= Html::a('Ofrezco Perro en Adopción &raquo;', ['aviso/create', 'tipo_aviso' => 3], ['class' => 'btn btn-info btn-lg']) ?>
                    </div>
                        <br><br>
                        <?= Yii::$app->getUser()->isGuest? '<h4 class="text-center text-info"><i class="fa fa-info-circle"></i>'.Html::encode(' Debe loguearse o darse de alta para publicar').'</h4>':'' ?>
                </div><!-- row -->
                <br><br><br><br>
            </div>
        </div>
    </div>
</div>
<div class="text-center responsive">
    <?= Html::img('@web/img/dog.png', ['height' => 300, 'alt' => 'Puro Perro', 'name' => 'puro_perro'])?>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <strong><h1 class="text-center"><i class="fa fa-smile-o"></i><?= Html::encode(' Finales Felices!!') ?></h1></strong>
    </div>
    <div class="panel-body text-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView'=>'_view',
            ]);
            ?>
        </div>
    </div>
</div>
