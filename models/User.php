<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use yii\helpers\ArrayHelper;
use app\models\Rol;
use app\models\EstadoUser;
use app\models\TipoUser;
use app\models\Perfil;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\behaviors\BlameableBehavior;

/**
 * User model
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $apodo
 * @property string $nombre
 * @property string $apellido
 * @property string $domicilio
 * @property integer $telefono_fijo
 * @property integer $telefono_celular
 * @property integer $localidad_id
 * @property integer $estado_usuario_id
 * @property integer $tipo_usuario_id
 * @property integer $rol_id
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $created_at
 * @property string $updated_at
 * @property integer $desea_adoptar
 * @property integer $ofrece_transito
 * @property double $latitud
 * @property double $longitud
 *
 * @property Aviso[] $avisos
 * @property Aviso[] $avisos0
 * @property Imagen[] $imagens
 * @property Imagen[] $imagens0
 * @property Tratamiento[] $tratamientos
 * @property EstadoUsuario $estadoUsuario
 * @property Rol $rol
 * @property TipoUser $tipoUsuario
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ESTADO_ACTIVO = 1;
    const ROLE_USER = 1; 
    const ROLE_ADMIN = 2; 

    public static function tableName()
    {
        return 'user';
    }

    /**
     * behaviors
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
            
            //BlameableBehavior::className(),
            
        ];
    }

    /**
     * reglas de validación
     */
    public function rules()
    {
        return [
            [['estado_usuario_id'], 'in', 'range' => array_keys($this->getEstadoLista())],
//            ['rol_id', 'default', 'value' => 1],
//            ['tipo_usuario_id', 'default', 'value' => 1],
//            [['tipo_usuario_id'], 'in', 'range' => array_keys($this->getTipoUserLista())],
            [['telefono_fijo', 'telefono_celular'], 'string', 'max' => 25],
            [['telefono_celular'], 'unique'],
            [['telefono_celular'], 'required'],
            [['apodo', 'nombre', 'apellido', 'domicilio', 'localidad_id', 'email', 'auth_key', 'password'], 'required'],
            [['telefono_fijo', 'telefono_celular', 'localidad_id', 'estado_usuario_id', 'tipo_usuario_id', 'rol_id', 'desea_adoptar', 'ofrece_transito'], 'integer'],
            ['apodo', 'filter', 'filter' => 'trim'],
            ['apodo', 'required'],
            ['apodo', 'unique'],
            ['apodo', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            [['created_at', 'updated_at'], 'safe'],
            [['apodo', 'nombre', 'apellido'], 'string', 'max' => 45],
            [['domicilio'], 'string', 'max' => 100],
            [['latitud', 'longitud'], 'number'],
//            [['auth_key'], 'string', 'max' => 32],
//            [['estado_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoUser::className(), 'targetAttribute' => ['estado_usuario_id' => 'id']],
//            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'id']],
//            [['tipo_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUser::className(), 'targetAttribute' => ['tipo_usuario_id' => 'id']],
//            [['localidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Localidad::className(), 'targetAttribute' => ['localidad_id' => 'id']],

            //------
//            [['apodo', 'email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
//            [['auth_key'], 'string', 'max' => 32],
//            [['apodo'], 'unique'],
//            [['estado_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoUser::className(), 'targetAttribute' => ['estado_usuario_id' => 'id']],
//            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'id']],
//            [['tipo_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUser::className(), 'targetAttribute' => ['tipo_usuario_id' => 'id']],
        ];
    }

    /* Las etiquetas de los atributos de su modelo */
    public function attributeLabels()
    {
        return [
            /* Sus otras etiquetas de atributo */
            'id' => 'ID',
            'apodo' => 'Apodo',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'domicilio' => 'Domicilio',
            'telefono_fijo' => 'Telefono Fijo',
            'telefono_celular' => 'Telefono Celular',
            'localidad_id' => 'Localidad',
            'desea_adoptar' => 'Desea Adoptar',
            'ofrece_transito' => 'Ofrece Transito',
            'estado_usuario_id' => 'Estado User',
            'tipo_usuario_id' => 'Tipo User',
            'rol_id' => 'Rol',
            'email' => 'E-mail',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',

            'rolNombre' => Yii::t('app', 'Rol'),
            'estadoNombre' => Yii::t('app', 'Estado'),
            'perfilId' => Yii::t('app', 'Perfil'),
            'perfilLink' => Yii::t('app', 'Perfil'),
            'userLink' => Yii::t('app', 'User'),
            'apodo' => Yii::t('app', 'User'),
            'tipoUserNombre' => Yii::t('app', 'Tipo User'),
            'tipoUserId' => Yii::t('app', 'Tipo User'),
            'userIdLink' => Yii::t('app', 'ID'),
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
        ];
    }

    /**
     * @findIdentity
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Encuentra user por apodo
     * @param string $apodo
     * @return static|null
     */
    public static function findByUsername($apodo)
    {
        return static::findOne(['apodo' => $apodo]);
    }

    /**
     * Encuentra user por clave de restablecimiento de password
     *
     * @param string $token clave de restablecimiento de password
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * Determina si la clave de restablecimiento de password es válida
     *
     * @param string $token clave de restablecimiento de password
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @getId
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @getAuthKey
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @validateAuthKey
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Valida password
     *
     * @param string $password password a validar
     * @return boolean si la password provista es válida para el user actual
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    /**
     * Genera hash de password a partir de password y la establece en el modelo
     * @setPassword
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Genera clave de autenticación "recuerdame"
     * @generateAuthKey
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Genera nueva clave de restablecimiento de password
     * @generatePasswordResetToken
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Remueve clave de restablecimiento de password
     * @removePasswordResetToken
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @getPerfil 
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::className(), ['user_id' => 'id']);
    }

    /**
     * @getRol relacion get rol
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }

    /**
     * @getRolNombre get rol nombre
     */
    public function getRolNombre()
    {
        return $this->rol ? $this->rol->rol_nombre : '- sin rol -';
    }

    /**
     * @getRolLista get lista de roles para roles desplegables
     */
    public static function getRolLista()
    {
        $dropciones = Rol::find()->asArray()->all();
        
        return ArrayHelper::map($dropciones, 'id', 'rol_nombre');
    }

    /**
     * @getEstado relacion get estado
     */
    public function getEstado()
    {
        return $this->hasOne(EstadoUser::className(), ['id' => 'estado_usuario_id']);
    }
    
    /**
     * @getEstadoNombre get estado nombre
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoNombre()
    {
        return $this->estado ? $this->estado->estado_nombre : '- sin estado -';
    }

    /**
     * @getEstadoLista get lista de estados para lista desplegable
     */

    public static function getEstadoLista()
    {
        $dropciones = EstadoUser::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'estado_nombre');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUsuario()
    {
       return $this->hasOne(TipoUser::className(), ['id' => 'tipo_usuario_id']);
    }

    /**
     * @getTipoUserNombre get tipo user nombre
     */
    public function getTipoUsuarioNombre()
    {
        return $this->tipoUsuario ? $this->tipoUsuario->tipo_user_nombre : '- sin tipo user -';
    }

    /**
     * @getTipoUserLista get lista de tipo user para lista desplegable
     */
    public static function getTipoUserLista()
    {
        $dropciones = TipoUser::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'tipo_user_nombre');
    }

    /**
     * @getTipoUserId
     */
    public function getTipoUserId()
    {
        return $this->tipoUser ? $this->tipoUser->id : 'ninguno';
    }

    /**
     * @getPerfilId
     */
    public function getPerfilId()
    {
        return $this->perfil ? $this->perfil->id : 'ninguno';
    }

    /**
     * @getPerfilLink
     */
    public function getPerfilLink()
    {
        $url = Url::to(['perfil/view', 'id' => $this->perfilId]);
        $opciones = [];
        return Html::a($this->perfil ? 'perfil' : 'ninguno', $url, $opciones);
    }

    /**
     * @getUserIdLink
     */
    public function getUserIdLink()
    {
        $url = Url::to(['user/update', 'id' => $this->id]);
        $opciones = [];
        return Html::a($this->id, $url, $opciones);
    }

    /**
     * @getUserLink
     */
    public function getUserLink()
    {
        $url = Url::to(['use/view', 'id' => $this->id]);
        $opciones = [];
        return Html::a($this->apodo, $url, $opciones);
    }
    
    public static function roleInArray($arr_role) 
    { 
        return in_array(Yii::$app->user->identity->rol_id, $arr_role); 
    }


    /**
     * @getLocalidad relacion get localidad
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidad()
    {
        return $this->hasOne(Localidad::className(), ['id' => 'localidad_id']);
    }

    /**
     * @return string
     */
    public function getDeseaAdoptarSiNo() {
        return $this->desea_adoptar?'Si':'No';
    }

    /**
     * @return string
     */
    public function getOfreceTransitoSiNo() {
        return $this->ofrece_transito?'Si':'No';
    }

    
} 