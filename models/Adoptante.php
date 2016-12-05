<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "adoptante".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $estado_adoptante_id
 * @property integer $tiene_otros_perros
 * @property integer $tiene_ninios
 * @property integer $tiene_patio_cerrado
 * @property integer $tiene_gatos
 * @property integer $deja_casa_sola_muchas_horas
 * @property integer $puede_atender_mascota_enferma
 * @property integer $acepta_visitas_de_control
 * @property string $comentarios
 * @property string $nota_admin
 *
 * @property EstadoAdoptante $estadoAdoptante
 * @property User $user
 */
class Adoptante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adoptante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'estado_adoptante_id', 'tiene_otros_perros', 'tiene_ninios', 'tiene_patio_cerrado', 'tiene_gatos', 'deja_casa_sola_muchas_horas', 'puede_atender_mascota_enferma', 'acepta_visitas_de_control'], 'integer'],
            [['comentarios'], 'string'],
            [['nota_admin'], 'string', 'max' => 255],
            [['estado_adoptante_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoAdoptante::className(), 'targetAttribute' => ['estado_adoptante_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'estado_adoptante_id' => 'Estado de adoptante',
            'tiene_otros_perros' => 'Tiene otros perros?',
            'tiene_ninios' => 'Tiene niños?',
            'tiene_patio_cerrado' => 'Tiene patio cerrado?',
            'tiene_gatos' => 'Tiene gatos?',
            'deja_casa_sola_muchas_horas' => 'Deja la casa sola muchas horas?',
            'puede_atender_mascota_enferma' => 'Puede atender una mascota enferma?',
            'acepta_visitas_de_control' => 'Acepta visitas domiciliarias de control?',
            'comentarios' => 'Comentarios',
            'nota_admin' => 'Nota del Administrador',
        ];
    }

    public function attributes(){
        return array_merge(parent::attributes(), ['user.apodo', 'estado.nombre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoAdoptante()
    {
        return $this->hasOne(EstadoAdoptante::className(), ['id' => 'estado_adoptante_id']);
    }

//    /**
//     * @return string
//     */
//    public function getEstadoAdoptanteNombre()
//    {
//        return $this->estadoAdoptante->nombre;
//    }

    /**
     * @return string
     */
    public function getEstadoAdoptanteNombre() {
        return isset($this->estadoAdoptante)? $this->estadoAdoptante->nombre : '-- Sin Datos --';
    }

    /**
     * @return string
     */
    public function getSiNoNose($val){
        switch ($val) {
            case 0:
                return 'No';
            case 1:
                return 'Sí';
            case 2:
                return 'No Sé';
            default:
                return '-- Sin Datos --';
        }
    }

    /**
     * @return string
     */
    public function getTieneOtrosPerrosSiNo() {
        return $this->getSiNoNose($this->tiene_otros_perros);
    }

    /**
     * @return string
     */
    public function getTieneNiniosSiNo() {
        return $this->getSiNoNose($this->tiene_ninios);
    }

    /**
     * @return string
     */
    public function getTienePatioCerradoSiNo() {
        return $this->getSiNoNose($this->tiene_patio_cerrado);
    }

    /**
     * @return string
     */
    public function getTieneGatosSiNo() {
        return $this->getSiNoNose($this->tiene_gatos);
    }

    /**
     * @return string
     */
    public function getPuedeAtenderMascotaEnfermaSiNo() {
        return $this->getSiNoNose($this->puede_atender_mascota_enferma);
    }

    /**
     * @return string
     */
    public function getDejaCasaSolaMuchasHorasSiNo() {
        return $this->getSiNoNose($this->deja_casa_sola_muchas_horas);
    }

    /**
     * @return string
     */
    public function getAceptaVisitasDeControlSiNo() {
        return $this->getSiNoNose($this->acepta_visitas_de_control);
    }

    /**
     * get lista opciones para lista desplegable
     */
    public static function getSiNo()
    {
        $droptions = ['0' => 'No', '1' => 'Sí', '2' => 'No Sé' ];
        return ArrayHelper::map($droptions);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return string
     */
    public function getUserApodo()
    {
        return $this->user->apodo;
    }

}
