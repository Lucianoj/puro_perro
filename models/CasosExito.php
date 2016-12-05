<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "casos_exito".
 *
 * @property integer $id
 * @property integer $aviso_id
 * @property integer $perro_id
 * @property string $mensaje
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $foto_reencuentro
 *
 * @property User $createdBy
 * @property Aviso $aviso
 * @property Perro $perro
 */
class CasosExito extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'casos_exito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['aviso_id', ], 'required'],
            [['aviso_id', 'perro_id', 'created_by', 'updated_by'], 'integer'],
            [['mensaje'], 'string'],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024,'checkExtensionByMimeType'=>false],
            [['created_at', 'updated_at'], 'safe'],
            [['foto_reencuentro'], 'string', 'max' => 200],
        ];
    }

    public function attributes(){
        return array_merge(parent::attributes(), ['aviso.titulo', 'perro.nombre', 'user.apodo']);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aviso_id' => 'Aviso',
            'perro_id' => 'Perro',
            'mensaje' => 'Mensaje',
            'file' => 'Foto',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'foto_reencuentro' => 'Foto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAviso()
    {
        return $this->hasOne(Aviso::className(), ['id' => 'aviso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerro()
    {
        return $this->hasOne(Perro::className(), ['id' => 'perro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }


    /**
     * behaviors (comportamientos para el control del timestamp)
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],

            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
