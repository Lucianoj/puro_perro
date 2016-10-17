<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_tratamiento".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Tratamiento[] $tratamientos
 */
class EstadoTratamiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_tratamiento';
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
    public function getTratamientos()
    {
        return $this->hasMany(Tratamiento::className(), ['estado_tratamiento_id' => 'id']);
    }
}
