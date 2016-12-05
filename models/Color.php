<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "color".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Perro[] $perros
 * @property Perro[] $perros0
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerros()
    {
        return $this->hasMany(Perro::className(), ['color_primario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerros0()
    {
        return $this->hasMany(Perro::className(), ['color_secundario' => 'id']);
    }
}
