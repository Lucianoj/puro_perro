<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $apodo;
    public $nombre;
    public $apellido;
    public $domicilio;
    public $telefono_fijo;
    public $telefono_celular;
    public $localidad_id;
    public $desea_adoptar;
    public $ofrece_transito;
    public $email;
    public $rol_id;
    public $password;
    public $password_repeat;
    public $latitud;
    public $longitud;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apodo', 'nombre','apellido','domicilio', 'telefono_celular', 'localidad_id', 'email', 'password'], 'required'],
            [['email'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['apodo'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este usuario ya existe.'],
            [['email'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este E-mail ya existe.'],
            [['telefono_celular'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este celular ya existe.'],
            [['telefono_fijo'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este teléfono ya existe.'],
            [['apodo'], 'string', 'min' => 2, 'max' => 100],
            [['telefono_fijo', 'telefono_celular'], 'number'],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Las contraseñas no coinciden" ],
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'apodo' => Yii::t('app', 'Usuario').' (*)',
            'nombre' => Yii::t('app', 'Nombre').' (*)',
            'apellido' => Yii::t('app', 'Apellido').' (*)',
            'domicilio' => Yii::t('app', 'Domicilio').' (*)',
            'telefono_celular' => Yii::t('app', 'Celular').' (*)',
            'telefono_fijo' => Yii::t('app', 'Teléfono Fijo'),
            'desea_adoptar' => Yii::t('app', 'Desea Adoptar?'),
            'ofrece_transito' => Yii::t('app', 'Ofrece Tránsito?'),
            'localidad_id' => Yii::t('app', 'Localidad').' (*)',
            'email' => Yii::t('app', 'E-mail').' (*)',
            'rol_id' => Yii::t('app', 'Rol'),
            'password' => Yii::t('app', 'Contraseña').' (*)',
            'password_repeat' => Yii::t('app', 'Repetir Contraseña').' (*)',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->apodo = $this->apodo;
            $user->nombre = $this->nombre;
            $user->apellido = $this->apellido;
            $user->domicilio = $this->domicilio;
            $user->latitud = $this->latitud;
            $user->longitud = $this->longitud;
            $user->localidad_id = $this->localidad_id;
            $user->desea_adoptar = $this->desea_adoptar?'1':'0';
            $user->ofrece_transito = $this->ofrece_transito?'1':'0';;
            $user->email = $this->email;
            $user->telefono_fijo = $this->telefono_fijo;
            $user->telefono_celular = $this->telefono_celular;
            $user->tipo_usuario_id = 1;
            $user->rol_id = $this->rol_id?$this->rol_id:1;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
