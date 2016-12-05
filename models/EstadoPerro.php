<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_perro".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Perro[] $perros
 */
class EstadoPerro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_perro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 100],
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
        return $this->hasMany(Perro::className(), ['estado_perro_id' => 'id']);
    }
}
