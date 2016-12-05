<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "perro".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $estado_perro_id
 * @property integer $estado_clinico_id
 * @property integer $color_primario
 * @property integer $color_secundario
 * @property integer $raza_id
 * @property integer $tamanio_id
 * @property integer $tiene_collar
 * @property integer $esta_enfermo
 * @property integer $tiene_marca_visible
 * @property string $marca_visible_detalle
 * @property integer $le_faltan_miembros
 * @property integer $sexo_id
 * @property integer $preniada
 * @property integer $edad_estimada
 * @property integer $cola_cortada
 * @property integer $orejas_cortadas
 * @property integer $castrada
 * @property string $foto
 * @property integer $tipo_pelo_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Aviso[] $avisos
 * @property Imagen[] $imagens
 * @property EstadoPerro $estadoPerro
 * @property Sexo $sexo
 * @property User $updatedBy
 * @property User $createdBy
 * @property Color $colorPrimario
 * @property EstadoClinico $estadoClinico
 * @property Color $colorSecundario
 * @property Raza $raza
 * @property TipoPelo $tipoPelo
 * @property Tamanio $tamanio
 * @property Tratamiento[] $tratamientos
 */
class Perro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perro';
    }

    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'estado_perro_id', 'estado_clinico_id', 'color_primario', 'color_secundario', 'raza_id', 'tamanio_id', 'edad_estimada', 'tipo_pelo_id'], 'required'],
            [['estado_perro_id', 'estado_clinico_id', 'color_primario', 'color_secundario', 'raza_id', 'tamanio_id', 'tiene_collar', 'esta_enfermo', 'tiene_marca_visible', 'le_faltan_miembros', 'sexo_id', 'preniada', 'edad_estimada', 'cola_cortada', 'orejas_cortadas', 'castrada', 'tipo_pelo_id', 'created_by', 'updated_by'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['created_at', 'updated_at'], 'safe'],
            [['marca_visible_detalle'], 'string', 'max' => 250],
            [['foto'], 'string', 'max' => 200],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024,'checkExtensionByMimeType'=>false],
//            [['estado_perro_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoPerro::className(), 'targetAttribute' => ['estado_perro_id' => 'id']],
//            [['estado_perro_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoPerro::className(), 'targetAttribute' => ['estado_perro_id' => 'id']],
//            [['color_primario'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_primario' => 'id']],
//            [['estado_clinico_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoClinico::className(), 'targetAttribute' => ['estado_clinico_id' => 'id']],
//            [['color_secundario'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_secundario' => 'id']],
//            [['raza_id'], 'exist', 'skipOnError' => true, 'targetClass' => Raza::className(), 'targetAttribute' => ['raza_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'user_id' => 'Usuario',
            'estado_perro_id' => 'Situación (paradero)',
            'estado_clinico_id' => 'Estado Clínico',
            'color_primario' => 'Color Principal',
            'color_secundario' => 'Color Secundario',
            'raza_id' => 'Raza',
            'tamanio_id' => 'Tamaño',
            'tiene_collar' => 'Tiene Collar',
            'esta_enfermo' => 'Está Enfermo',
            'tiene_marca_visible' => 'Tiene Marca Visible',
            'marca_visible_detalle' => 'Detalle de Marca Visible',
            'le_faltan_miembros' => 'Le Faltan Miembros',
            'tipo_pelo_id' => 'Tipo de Pelo',
            'sexo_id' => 'Sexo',
            'preniada' => 'Perra Preñada',
            'file' => 'Foto',
            'edad_estimada' => 'Edad Estimada',
            'cola_cortada' => 'Cola Cortada',
            'orejas_cortadas' => 'Orejas Cortadas',
            'castrada' => 'Castrado/a',
            'foto' => 'Foto',
        ];
    }

    public function attributes(){
        return array_merge(parent::attributes(), ['estado_clinico.nombre', 'estado_perro.nombre', 'raza.nombre', 'user.apodo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   public function getTipoPelo()
   {
       return $this->hasOne(TipoPelo::className(), ['id' => 'tipo_pelo_id']);
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTamanio()
    {
        return $this->hasOne(Tamanio::className(), ['id' => 'tamanio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Aviso::className(), ['perro_id' => 'id']);
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
    public function getResponsable()
    {
        return $this->createdBy->apodo;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagen::className(), ['perro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPerro()
    {
        return $this->hasOne(EstadoPerro::className(), ['id' => 'estado_perro_id']);
    }

    /**
     * @return string
     */
    public function getEstadoPerroNombre()
    {
        return $this->estadoPerro->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'estado_perro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorPrimario()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_primario']);
    }

    /**
     * @return string
     */
    public function getColorPrimarioNombre()
    {
        return $this->colorPrimario->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoClinico()
    {
        return $this->hasOne(EstadoClinico::className(), ['id' => 'estado_clinico_id']);
    }

    /**
     * @return string
     */
    public function getEstadoClinicoNombre()
    {
        return $this->estadoClinico->nombre;
    }

    /**
     * @return string
     */
    public function getEstadoClinicoInfo()
    {
        return $this->estadoClinico->descripcion;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorSecundario()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_secundario']);
    }

    /**
     * @return string
     */
    public function getColorSecundarioNombre()
    {
        return $this->colorSecundario->nombre;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaza()
    {
        return $this->hasOne(Raza::className(), ['id' => 'raza_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'sexo_id']);
    }

    /**
     * @return string
     */
    public function getSexoNombre()
    {
        return $this->sexo->nombre;
    }

    /**
     * @return string
     */
    public function getRazaNombre()
    {
        return $this->raza->nombre;
    }

    /**
     * @return string
     */
    public function getTipoPeloNombre()
    {
        return $this->tipoPelo->nombre;
    }

    /**
     * @return string
     */
    public function getTamanioNombre()
    {
        return $this->tamanio->nombre;
    }

    /**
     * @return string
     */
    private function siNoNose($val){
        switch ($val) {
            case 0:
                return 'No';
            case 1:
                return 'Sí';
            case 2:
                return 'No Sé';
            default:
                return '-- Sin Datos --';
        }
    }

    /**
     * @return string
     */
    public function getTieneCollarSiNo()
    {
        return $this->siNoNose($this->tiene_collar);
    }

    /**
     * @return string
     */
    public function getOrejasCortadasSiNo()
    {
        return $this->siNoNose($this->orejas_cortadas);
    }

    /**
     * @return string
     */
    public function getEstaEnfermoSiNo()
    {
        return $this->siNoNose($this->esta_enfermo);
    }

    /**
     * @return string
     */
    public function getColaCortadaSiNo()
    {
        return $this->siNoNose($this->cola_cortada);
    }

    /**
     * @return string
     */
    public function getTieneMarcaVisibleSiNo()
    {
        return $this->siNoNose($this->tiene_marca_visible);
    }

    /**
     * @return string
     */
    public function getLeFaltanMiembrosSiNo()
    {
        return $this->siNoNose($this->le_faltan_miembros);
    }

    /**
     * @return string
     */
    public function getPreniadaSiNo()
    {
        return $this->siNoNose($this->preniada);
    }

    /**
     * @return string
     */
    public function getCastradaSiNo()
    {
        return $this->siNoNose($this->castrada);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamiento::className(), ['perro_id' => 'id']);
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
