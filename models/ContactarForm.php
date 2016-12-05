<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 07/11/16
 * Time: 15:12
 */
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactarForm is the model behind the contactar form.
 */
class ContactarForm extends Model
{
    public $user_id;
    public $email;
    public $aviso_id;
    public $motivo;
    public $mensaje;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['motivo'], 'required'],
            [['mensaje'], 'string'],
            // email has to be a valid email address
//            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact()
    {
        $modelUserFrom = User::findOne(['id' => Yii::$app->getUser()->id]);
        $modelUserTo = User::findOne(['id' => $this->user_id]);
        $url = Yii::$app->urlManager->createAbsoluteUrl(['aviso/view', 'id' => $this->aviso_id]);
        $mensaje  = '<h2> Hola ' . $modelUserTo->apodo . ', desde Puro Perro te llega este mensaje que te envía: ' . $modelUserFrom->apodo . '</h2><br>';
        $mensaje .= '<H3>' . $this->motivo  .'</H3><br><br>';
        $mensaje .= 'Mensaje: <br>' . $this->mensaje . '<br><br>';
        $mensaje .= 'Los datos del usuario son: <br>';
        $mensaje .= 'Nombre: ' . $modelUserFrom->nombre . ' ' . $modelUserFrom->apellido . '<br>';
        $mensaje .= 'Email: ' . $modelUserFrom->email . '<br>';
        $mensaje .= 'Celular: ' . $modelUserFrom->telefono_celular . '<br>';
        $mensaje .= 'Aviso de referencia: ' . $url . '<br>';

        Yii::$app->mailer->compose()
            ->setTo($modelUserTo->email)
            ->setFrom([$modelUserFrom->email => $modelUserFrom->apodo. ' en ' . \Yii::$app->name . ' [robot]'])
            ->setSubject($this->motivo)
            ->setHtmlBody($mensaje)
            ->send();

        return true;
    }
}