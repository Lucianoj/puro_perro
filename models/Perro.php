<?php

namespace app\models;

use Yii;

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
 *
 * @property Aviso[] $avisos
 * @property Imagen[] $imagens
 * @property EstadoPerro $estadoPerro
 * @property Color $colorPrimario
 * @property EstadoClinico $estadoClinico
 * @property Color $colorSecundario
 * @property Raza $raza
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'estado_perro_id', 'estado_clinico_id', 'color_primario', 'color_secundario', 'raza_id'], 'required'],
            [['estado_perro_id', 'estado_clinico_id', 'color_primario', 'color_secundario', 'raza_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['estado_perro_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoPerro::className(), 'targetAttribute' => ['estado_perro_id' => 'id']],
            [['color_primario'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_primario' => 'id']],
            [['estado_clinico_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoClinico::className(), 'targetAttribute' => ['estado_clinico_id' => 'id']],
            [['color_secundario'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_secundario' => 'id']],
            [['raza_id'], 'exist', 'skipOnError' => true, 'targetClass' => Raza::className(), 'targetAttribute' => ['raza_id' => 'id']],
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
            'estado_perro_id' => 'Estado Perro ID',
            'estado_clinico_id' => 'Estado Clinico ID',
            'color_primario' => 'Color Primario',
            'color_secundario' => 'Color Secundario',
            'raza_id' => 'Raza ID',
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getColorPrimario()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_primario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoClinico()
    {
        return $this->hasOne(EstadoClinico::className(), ['id' => 'estado_clinico_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorSecundario()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_secundario']);
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
    public function getTratamientos()
    {
        return $this->hasMany(Tratamiento::className(), ['perro_id' => 'id']);
    }
}
