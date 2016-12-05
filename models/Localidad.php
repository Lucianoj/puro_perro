<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localidad".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $provincia_id
 *
 * @property Provincia $provincia
 * @property User[] $users
 * @property Veterinaria[] $veterinarias
 */
class Localidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'localidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'provincia_id'], 'required'],
            [['provincia_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provincia_id' => 'id']],
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
            'provincia_id' => 'Provincia ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['id' => 'provincia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['localidad_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarias()
    {
        return $this->hasMany(Veterinaria::className(), ['localidad_id' => 'id']);
    }
}
