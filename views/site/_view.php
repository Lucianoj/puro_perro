<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 20/11/16
 * Time: 21:30
 */


use yii\helpers\Html;
use app\models\Perro;
use app\models\Aviso;
/* @var $this AvisoController */
/* @var $model Aviso */
?>
<?php
$modelPerro = Perro::findOne(['id' => $model->perro_id]);
$modelAviso = Aviso::findOne(['id' => $model->aviso_id]);
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
    <div class="<?=$class?>">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h5 class="<?=$classText?>"><?php echo Html::encode('Título Original: '.$modelAviso->titulo) ?></h5>
            <h6 class="text-center text-primary"><?php echo Html::encode(substr($model->mensaje, 0, 100).'...'); ?></h6>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <img class="img-responsive" src="<?=$model->foto_reencuentro?>" alt="<?=$modelPerro->nombre?>" width = 150></img>
        </div>
        <p class="text-center"><?= Html::a(Html::encode('Ver Aviso'), ['aviso/view', 'id' => $modelAviso->id]) ?></p>
    </div>
</div>

