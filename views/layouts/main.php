<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\FontAwesomeAsset;
use app\models\PermisosHelpers;
use kartik\icons\Icon;
use app\models\search\TipoAviso;


AppAsset::register($this);
FontAwesomeAsset::register($this);

$esInvitado = Yii::$app->user->isGuest;
$es_root = !$esInvitado && PermisosHelpers::requerirRol('root');
$es_admin = !$esInvitado && PermisosHelpers::requerirRol('admin');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Puro Perro',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    $modelsTipoAviso = TipoAviso::find()->orderBy('id')->all();
    foreach ($modelsTipoAviso as $modelTipoAviso) {
        $avisos [] = ['label' => $modelTipoAviso->nombre, 'url' => ['aviso/index', 'tipo' => $modelTipoAviso->id, 'id' => 0]];
    }
    $avisos [] = ['label' => 'Todos los Avisos', 'url' => ['aviso/index', 'tipo' => 0, 'id' => 0]];
    $avisos [] = ['label' => 'Finales Felices', 'url' => ['casos-exito/index']];

    if($esInvitado) {
        echo NavX::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Ver Avisos', 'items' => $avisos],
                ['label' => 'Alta', 'url' => ['/site/signup']],
                ['label' => 'Ingresar', 'url' => ['/site/login']]
            ],
        ]);
        NavBar::end();
    } else if($es_root || $es_admin) {
        echo NavX::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Mi Perfil', 'url' => ['/user/view/', 'id' => Yii::$app->user->id]],
                ['label' => 'Mis Avisos', 'items' => [
                    ['label' => 'Ver mis avisos', 'url' => ['aviso/index', 'tipo' => 0, 'id' => Yii::$app->user->id]],
                    ['label' => 'Crear Aviso', 'items' => [
                        ['label' => 'Perro Perdido', 'url' => ['aviso/create', 'tipo_aviso' => 1]],
                        ['label' => 'Perro Encontrado', 'url' => ['aviso/create', 'tipo_aviso' => 2]],
                        ['label' => 'Perro en Adopción', 'url' => ['aviso/create', 'tipo_aviso' => 3]],
                        ],
                    ],
                    ],
                ],
                ['label' => 'Ver Avisos', 'items' => $avisos],
                ['label' => 'Administrar', 'items' => [
                    ['label' => 'Administrar Usuarios', 'url' => ['/user/index']],
                    ['label' => 'ABMs', 'items' => [
                        ['label' => 'Usuarios', 'url' => ['user/index']],
                        ['label' => 'Adoptantes', 'url' => ['adoptante/index']],
                        '<li class="divider"></li>',
                        ['label' => 'Perros', 'url' => ['perro/index']],
                        ['label' => 'Estados Perro', 'url' => ['estado-perro/index']],
                        ['label' => 'Estados Clínicos', 'url' => ['estado-clinico/index']],
                        '<li class="divider"></li>',
                        ['label' => 'Estados Imágenes', 'url' => ['estado-imagen/index']],
                        ['label' => 'Estados Avisos', 'url' => ['estado-aviso/index']],
                        ['label' => 'Tipos de Aviso', 'url' => ['tipo-aviso/index']],
                        ],
                    ],
                    ['label' => 'Administrar Avisos', 'items' => [
                        ['label' => 'Avisos Abiertos', 'url' => ['aviso/index-admin','estado' => 1, 'id' => 0]],
                        ['label' => 'Avisos Cerrados', 'url' => ['aviso/index-admin', 'estado' => 2,'id' => 0]],
                        ['label' => 'Avisos Reportados', 'url' => ['aviso/index-admin', 'estado' => 3, 'id' => 0]],
                        ['label' => 'Avisos Eliminados', 'url' => ['aviso/index-admin', 'estado' => 4, 'id' => 0]],
                        ['label' => 'Todos los Avisos', 'url' => ['aviso/index-admin', 'estado' => 0, 'id' => 0]],
                        ],
                    ],
                    ],
                ],
                [
                    'label' => 'Salir ('.Yii::$app->user->identity->apodo . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
            ],
        ]);
        NavBar::end();

    } else {
        echo NavX::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Mi Perfil', 'url' => ['/user/view/', 'id' => Yii::$app->user->id]],
                ['label' => 'Mis Avisos', 'items' => [
                    ['label' => 'Ver mis avisos', 'url' => ['aviso/index', 'estado' => 0, 'id' => Yii::$app->user->id]],
                    ['label' => 'Crear Aviso', 'items' => [
                        ['label' => 'Perro Perdido', 'url' => ['aviso/create', 'tipo_aviso' => 1]],
                        ['label' => 'Perro Encontrado', 'url' => ['aviso/create', 'tipo_aviso' => 2]],
                        ['label' => 'Perro en Adopción', 'url' => ['aviso/create', 'tipo_aviso' => 3]],
                        ],
                    ],
                    ],
                ],
                ['label' => 'Ver Avisos', 'items' => $avisos],
                [
                    'label' => 'Salir ('.Yii::$app->user->identity->apodo . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
            ],
        ]);
        NavBar::end();
        

    }
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Jáuregui - Rodriguez <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
