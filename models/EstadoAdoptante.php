<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_adoptante".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $valor
 */
class EstadoAdoptante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_adoptante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'valor'], 'required'],
            [['valor'], 'integer'],
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
            'valor' => 'Valor',
        ];
    }
}
