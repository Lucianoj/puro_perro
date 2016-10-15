<?php

namespace app\models;

use Yii;
use app\models\Rol;
use app\models\EstadoUser;
use app\models\TipoUsuario;
use app\models\User;

class ValorHelpers
{
    /**
     * @rolCoincide
     */
    public static function rolCoincide($rol_nombre)
    {
        $userTieneRolNombre = Yii::$app->user->identity->rol->rol_nombre;
        return $userTieneRolNombre == $rol_nombre ? true : false;
    }

    /**
     * @getUsersRolValor
     */
    public static function getUsersRolValor($userId = null)
    {
        if($userId == null){
            $usersRolValor = Yii::$app->user->identity->rol->rol_valor;
            return isset($usersRolValor) ? $usersRolValor : false;
        } else {
            $user = User::findOne($userId);
            $usersRolValor = $user->rol->rol_valor;
            return isset($usersRolValor) ? $usersRolValor : false;
        }
    }

    /**
     * 
     * @getRolValor
     */
    public static function getRolValor($rol_nombre)
    {
        $rol = Rol::find('rol_valor')->where(['rol_nombre' => $rol_nombre])->one();
        return isset($rol->rol_valor) ? $rol->rol_valor : false;
    }

    /**
     * @esRolNombreValido
     */
    public static function esRolNombreValido($rol_nombre)
    {
        $rol = Rol::find('rol_nombre')->where(['rol_nombre' => $rol_nombre])->one();
        return isset($rol->rol_nombre) ? true : false;
    }

    /**
     * @estadoCoincide
     */
    public static function estadoCoincide($estado_nombre)
    {
        $userTieneEstadoName = Yii::$app->user->identity->estado->estado_nombre;
        return $userTieneEstadoName == $estado_nombre ? true : false;
    }

    /**
     * @getEstadoId
     */
    public static function getEstadoId($estado_nombre)
    {
        $estado = EstadoUser::find('id')->where(['estado_nombre' => $estado_nombre])->one();
        return isset($estado->id) ? $estado->id : false;
    }

    /**
     * @tipoUsuarioCoincide
     */
    public static function tipoUsuarioCoincide($tipo_usuario_nombre)
    {
        $userTieneTipoUsuarioName = Yii::$app->user->identity->tipoUsuario->tipo_usuario_nombre;
        return $userTieneTipoUsuarioName == $tipo_usuario_nombre ? true : false;
    }
}