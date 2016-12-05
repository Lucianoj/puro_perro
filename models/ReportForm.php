<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 07/11/16
 * Time: 08:34
 */
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ReportForm is the model behind the report form.
 */
class ReportForm extends Model
{
    public $user_id;
    public $email;
    public $aviso_id;
    public $motivo;
    public $informacion;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['motivo'], 'required'],
            [['informacion'], 'string'],
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
    public function contact($email)
    {
        $modelUser = User::findOne(['id' => $this->user_id]);
        $url = Yii::$app->urlManager->createAbsoluteUrl(['aviso/view', 'id' => $this->aviso_id]);
        $mensaje = 'El usuario ' . $modelUser->apodo .' ha reportado la siguiente publicación: '. $url .' alegando : ' . $this->informacion;

        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$modelUser->email => $modelUser->apodo. ' en ' . \Yii::$app->name . ' [robot]'])
            ->setSubject($this->motivo)
            ->setTextBody($mensaje)
            ->send();

        return true;
    }
}