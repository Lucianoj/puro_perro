<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "rol".
 *
 * @property integer $id
 * @property string $rol_nombre
 * @property integer $rol_valor
 *
 * @property User[] $users
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_nombre', 'rol_valor'], 'required'],
            [['rol_valor'], 'integer'],
            [['rol_nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rol_nombre' => Yii::t('app', 'Rol Nombre'),
            'rol_valor' => Yii::t('app', 'Rol Valor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rol_id' => 'id']);
    }
}
