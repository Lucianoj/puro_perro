<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "raza".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Perro[] $perros
 */
class Raza extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raza';
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
        return $this->hasMany(Perro::className(), ['raza_id' => 'id']);
    }
}
