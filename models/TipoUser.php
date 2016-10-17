<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_user".
 *
 * @property integer $id
 * @property string $tipo_user_nombre
 * @property integer $tipo_user_valor
 */
class TipoUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_user_nombre', 'tipo_user_valor'], 'required'],
            [['tipo_user_valor'], 'integer'],
            [['tipo_user_nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_user_nombre' => Yii::t('app', 'Tipo User Nombre'),
            'tipo_user_valor' => Yii::t('app', 'Tipo User Valor'),
        ];
    }
}
