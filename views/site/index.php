<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\PermisosHelpers;

$es_invitado = Yii::$app->user->isGuest;
$this->title = 'Puro Perro';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><i class="fa fa-heart-o"></i> Puro Perro</h1>
    </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="text-center">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <h2><i class="fa fa-bullhorn"></i> Publicar Avisos</h2>

                        <p>Quiero publicar un aviso sobre un perro</p>

                        <?= Html::a('Publicar &raquo;', ['aviso/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="col-lg-6 text-center">
                        <h2><i class="fa fa-bug"></i> ABM Perros</h2>

                        <p>ABM Perros</p>

                        <?= Html::a('Ver Perros &raquo;', ['perro/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div><!-- row -->
            </div>
        </div>
    </div>
</div>
