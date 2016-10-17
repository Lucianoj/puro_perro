<?php

namespace app\models;

use Yii;
use yii\base\Model;
use \yii\web\NotFoundHttpException;
use app\models\PermisosHelpers;
use app\models\Usuario;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $apodo;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // apodo and password are both required
            [['apodo', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'apodo' => Yii::t('app', 'Usuario'),
            'password' => Yii::t('app', 'Contraseña'),
            'rememberMe' => Yii::t('app', 'Recordarme'),
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Nombre o contraseña incorrecta.');
            }
        }
    }

    /**
     * Logs in a user using the provided apodo and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } 
	return false;
    }

    /**
     * Finds user by [[Rapodo]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->apodo);
        }

        return $this->_user;
    }

    public function loginAdmin()
    {
        if (($this->validate() && PermisosHelpers::requerirMinimoRol('Admin', $this->getUser()->id))) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            throw new NotFoundHttpException('No tiene autorización para acceder.');
        }
    }
}
