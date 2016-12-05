<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_pelo".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Perro[] $perros
 */
class TipoPelo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_pelo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nombre'], 'required'],
            [['id'], 'integer'],
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
        return $this->hasMany(Perro::className(), ['tipo_pelo_id' => 'id']);
    }
}
