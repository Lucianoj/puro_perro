<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_clinico".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Perro[] $perros
 * @property Tratamiento[] $tratamientos
 */
class EstadoClinico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_clinico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 255],
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
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerros()
    {
        return $this->hasMany(Perro::className(), ['estado_clinico_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombredescripcion()
    {
        return $this->nombre.' ('.$this->descripcion.')';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamiento::className(), ['estado_clinico_id' => 'id']);
    }
}
