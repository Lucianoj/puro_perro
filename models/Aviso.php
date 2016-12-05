<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use app\models\Perro;

/**
 * This is the model class for table "aviso".
 *
 * @property integer $id
 * @property integer $tipo_aviso_id
 * @property integer $estado_aviso_id
 * @property string $direccion
 * @property double $latitud
 * @property double $longitud
 * @property string $informacion
 * @property string $fecha_evento
 * @property string $titulo
 * @property integer $perro_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property User $updatedBy
 * @property User $createdBy
 * @property TipoAviso $tipoAviso
 * @property EstadoAviso $estadoAviso
 * @property Perro $perro
 */
class Aviso extends \yii\db\ActiveRecord
{
    public $keyword;
    public $fecha_filtro;
    public $busqueda_avanzada;
    /*
     * Variables auxiliares para la busqueda avanzada
     */
    public $p_raza_id,
        $p_sexo_id,
        $p_nombre,
        $p_esta_enfermo,
        $p_estado_clinico_id,
        $p_color_primario,
        $p_color_secundario,
        $p_tiene_collar,
        $p_tamanio_id,
        $p_castrada,
        $p_preniada,
        $p_cola_cortada,
        $p_orejas_cortadas,
        $p_le_faltan_miembros,
        $p_tipo_pelo_id,
        $p_edad_estimada,
        $p_tiene_marca_visible,
        $p_marca_visible_detalle,
        $a_latitud,
        $a_longitud,
        $a_radio;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aviso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'tipo_aviso_id', 'direccion', 'fecha_evento','informacion'], 'required'],
            [['tipo_aviso_id', 'estado_aviso_id', 'created_by', 'perro_id', 'updated_by'], 'integer'],
            [['fecha_evento','created_at', 'updated_at'], 'safe'],
            [['informacion'], 'string'],
            [['latitud', 'longitud'], 'number'],
            [['a_latitud', 'a_longitud', 'a_radio'], 'number'],
            [['titulo'], 'string', 'max' => 100],
            [['keyword', 'p_nombre', 'p_marca_visible_detalle'], 'string', 'max' => 100],
            [['fecha_filtro'], 'string', 'max' => 10],
            [['busqueda_avanzada'], 'boolean'],
            [['direccion'], 'string', 'max' => 255],
            [[ 'p_estado_clinico_id', 'p_color_primario', 'p_color_secundario', 'p_raza_id', 'p_tamanio_id', 'p_tiene_collar', 'p_esta_enfermo', 'p_tiene_marca_visible', 'p_le_faltan_miembros', 'p_sexo_id', 'p_preniada', 'p_edad_estimada', 'p_cola_cortada', 'p_orejas_cortadas', 'p_castrada', 'p_tipo_pelo_id'], 'integer'],
//            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
//            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
//            [['tipo_aviso_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAviso::className(), 'targetAttribute' => ['tipo_aviso_id' => 'id']],
//            [['estado_aviso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoAviso::className(), 'targetAttribute' => ['estado_aviso_id' => 'id']],
//            [['perro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perro::className(), 'targetAttribute' => ['perro_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_aviso_id' => 'Tipo de Aviso',
            'estado_aviso_id' => 'Estado del Aviso',
            'titulo' => 'Título',
            'perro_id' => 'Perro',
            'latitud' => 'Latitud',
            'keyword' => 'Palabra Clave',
            'longitud' => 'Longitud',
            'informacion' => 'Información Adicional',
            'fecha_evento' => 'Fecha Evento',
            'fecha_filtro' => 'Fecha Evento',
            'direccion' => 'Dirección',
            'created_by' => 'Autor',
            'created_at' => 'Fecha Aviso',
            'updated_by' => 'Modificado Por',
            'updated_at' => 'Fecha Modificación',
            //---- Model Perro
            'p_nombre' => 'Nombre',
            'p_estado_perro_id' => 'Situación (paradero)',
            'p_estado_clinico_id' => 'Estado Clínico',
            'p_color_primario' => 'Color Principal',
            'p_color_secundario' => 'Color Secundario',
            'p_raza_id' => 'Raza',
            'p_tamanio_id' => 'Tamaño',
            'p_tiene_collar' => 'Tiene Collar',
            'p_esta_enfermo' => 'Está Enfermo',
            'p_tiene_marca_visible' => 'Tiene Marca Visible',
            'p_marca_visible_detalle' => 'Detalle de Marca Visible',
            'p_le_faltan_miembros' => 'Le Faltan Miembros',
            'p_tipo_pelo_id' => 'Tipo de Pelo',
            'p_sexo_id' => 'Sexo',
            'p_preniada' => 'Perra Preñada',
            'p_file' => 'Foto',
            'p_edad_estimada' => 'Edad Estimada',
            'p_cola_cortada' => 'Cola Cortada',
            'p_orejas_cortadas' => 'Orejas Cortadas',
            'p_castrada' => 'Castrado/a',
            'a_latitud' => 'Latitud',
            'a_longitud' => 'Longitud',
            'a_radio' => 'Radio de Búsqueda',
        ];
    }

    public function attributes(){
        return array_merge(parent::attributes(), ['estado.nombre', 'tipo.nombre', 'perro.nombre', 'user.apodo', 'perro.raza']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return string
     */
    public function getAutor()
    {
        return $this->createdBy->apodo;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAviso()
    {
        return $this->hasOne(TipoAviso::className(), ['id' => 'tipo_aviso_id']);
    }


    /**
     * @return string
     */
    public function getTipoAvisoNombre()
    {
        return $this->tipoAviso->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoAviso()
    {
        return $this->hasOne(EstadoAviso::className(), ['id' => 'estado_aviso_id']);
    }

    /**
     * @return string
     */
    public function getEstadoAvisoNombre()
    {
        return $this->estadoAviso->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerro()
    {
        return $this->hasOne(Perro::className(), ['id' => 'perro_id']);
    }

    /**
     * @return string
     */
    public function getPerroNombre()
    {
        return $this->perro->nombre;
    }

    //usarla en el modelo y desde index o view llamarla como
    /**
     * @return String
     */
    public function getCreatedAtOrdenado()
    {
        //Si la fecha es la de la base, sera aaaa-dd-mm HH:MM:SS
        $fecha = $this->created_at; //reemplazar por created o crear una funcion para cada uno de los datos
        $separador = '/';
        $auxFechaAnio = substr($fecha, 0, 4);
        $auxFechaMes = substr($fecha, 5, 2);
        $auxFechaDia = substr($fecha, 8, 2);
        $auxFechaHora = substr($fecha, 11, 5); //hora sin segundos

        // devuelve dd/mm/aaaa HH:MM
        return $auxFechaDia.$separador.$auxFechaMes.$separador.$auxFechaAnio." ".$auxFechaHora;
    }

    //usarla en el modelo y desde index o view llamarla como
    /**
     * @return String
     */
    public function getFechaEventoOrdenada()
    {
        //Si la fecha es la de la base, sera aaaa-dd-mm
        $fecha = $this->fecha_evento; //reemplazar por created o crear una funcion para cada uno de los datos
        $separador = '/';
        $auxFechaAnio = substr($fecha, 0, 4);
        $auxFechaMes = substr($fecha, 5, 2);
        $auxFechaDia = substr($fecha, 8, 2);

        // devuelve dd/mm/aaaa HH:MM
        return $auxFechaDia.$separador.$auxFechaMes.$separador.$auxFechaAnio;
    }

    //usarla en el modelo y desde index o view llamarla como
    /**
     * @return String
     */
    public function getUpdatedAtOrdenado()
    {
        //Si la fecha es la de la base, sera aaaa-dd-mm HH:MM:SS
        $fecha = $this->updated_at; //reemplazar por created o crear una funcion para cada uno de los datos
        $separador = '/';
        $auxFechaAnio = substr($fecha, 0, 4);
        $auxFechaMes = substr($fecha, 5, 2);
        $auxFechaDia = substr($fecha, 8, 2);
        $auxFechaHora = substr($fecha, 11, 5); //hora sin segundos

        // devuelve dd/mm/aaaa HH:MM
        return $auxFechaDia.$separador.$auxFechaMes.$separador.$auxFechaAnio." ".$auxFechaHora;
    }

    /**
     * behaviors (comportamientos para el control del timestamp)
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],

            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
