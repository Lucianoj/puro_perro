<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 06/11/16
 * Time: 17:46
 */

use yii\helpers\Html;
use app\models\Perro;
use yii\helpers\Url;
/* @var $this AvisoController */
/* @var $model Aviso */
?>
<?php
    $modelPerro = Perro::findOne(['id' => $model->perro_id]);
    switch ($modelPerro->estado_perro_id){
        case 1: { // 1 = perdido
            $class = 'panel panel-body panel-danger';
            $classText = 'text-center text-danger';
            break;
        }
        case 2: { // 2 = Encontrado
            $class = 'panel panel-body panel-primary';
            $classText = 'text-center text-primary';
            break;
        }
        case 3: { // 3 = Reencontrado
            $class = 'panel panel-body panel-success';
            $classText = 'text-center text-success';
            break;
        }
        case 4: { // 4 = Tránsito
            $class = 'panel panel-body panel-primary';
            $classText = 'text-center text-primary';
            break;
        }
        case 5: { // 3 = Adopcion
            $class = 'panel panel-body panel-primary';
            $classText = 'text-center text-primary';
            break;
        }
        case 6: { // 3 = Adoptado
            $class = 'panel panel-body panel-success';
            $classText = 'text-center text-success';
            break;
        }
}

?>
<div class="col-sm-6 col-md-6 col-lg-6">
    <div class="<?=$class?> text-center">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h5 class="<?=$classText?>"><?php echo Html::encode($model->titulo) ?></h5>
            <h6 class="text-center text-muted"><?php echo Html::encode(substr($model->informacion, 0, 50).'...'); ?></h6>
            <a class="btn btn-default" href="<?=Url::to(['aviso/view', 'id' => $model->id])?>">Ver Aviso</a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <img src="<?=$modelPerro->foto?>" alt="<?=$modelPerro->nombre?>" width = 150>
        </div>
    </div>
</div>

