<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aviso;

/**
 * AvisoSearch represents the model behind the search form about `app\models\Aviso`.
 */
class AvisoSearch extends Aviso
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_aviso_id', 'estado_aviso_id', 'created_by', 'perro_id', 'updated_by'], 'integer'],
            [['titulo', 'created_at', 'updated_at', 'direccion', 'informacion', 'user.apodo','estado.nombre', 'tipo.nombre', 'perro.nombre', 'perro.raza'], 'safe'],
            [['latitud', 'longitud'], 'number'],
            [['informacion', 'keyword', 'fecha_filtro'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    private function ordenarFechaParaGuardar($fecha) {
        //Si la fecha es la de la base, debera ser YYYY-MM-DD
        $separador = '-';
        $auxFechaDia = substr($fecha, 0, 2);
        $auxFechaMes = substr($fecha, 3, 2);
        $auxFechaAnio = substr($fecha, 6, 4);

        // devuelve dd/mm/aaaa HH:MM
        return $auxFechaAnio.$separador.$auxFechaMes.$separador.$auxFechaDia;
    }

    function distanciaGeodesica($lat1, $long1, $lat2, $long2){

        $degtorad = 0.01745329;
        $radtodeg = 57.29577951;

        $dlong = ($long1 - $long2);
        $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad)) + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad) * cos($dlong * $degtorad));

        $dd = acos($dvalue) * $radtodeg;

//        $miles = ($dd * 69.16);
        $km = ($dd * 111.302);

        return $km;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Aviso::find();

        // add conditions that should always apply here

        $query->innerJoin(['estado_aviso as estado'], 'estado.id = aviso.estado_aviso_id');
        $query->innerJoin(['user'], 'user.id = aviso.created_by');
        $query->innerJoin(['perro'], 'perro.id = aviso.perro_id');
        $query->innerJoin(['raza'], 'perro.raza_id = raza.id');
        $query->innerJoin(['sexo'], 'perro.sexo_id = sexo.id');
        $query->innerJoin(['tamanio'], 'perro.tamanio_id = tamanio.id');
        $query->innerJoin(['color'], '(perro.color_primario = color.id or perro.color_secundario = color.id)');
        $query->innerJoin(['estado_clinico'], 'perro.estado_clinico_id = estado_clinico.id');
        $query->innerJoin(['tipo_aviso tipo'], 'tipo.id = aviso.tipo_aviso_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->setSort([
            'attributes'=>[
                'informacion',
                'titulo',
                'created_at',
                'estado.nombre',
                'user.apodo',
                'tipo.nombre',
                'perro.nombre',
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'aviso.id' => $this->id,
            'tipo_aviso_id' => $this->tipo_aviso_id,
            'estado_aviso_id' => $this->estado_aviso_id,
            'perro_id' => $this->perro_id,
            'fecha_evento' => $this->fecha_evento,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'aviso.created_at' => $this->created_at,
            'aviso.created_by' => $this->created_by,
            'aviso.updated_at' => $this->updated_at,
            'aviso.updated_by' => $this->updated_by,
        ]);


        if($this->busqueda_avanzada == 1) {
            if(isset($params['AvisoSearch']['informacion']) && ($params['AvisoSearch']['informacion'] != ''))
                $query->andFilterWhere(['like', 'aviso.informacion', $params['AvisoSearch']['informacion']]);
            if(isset($params['AvisoSearch']['tipo_aviso_id']) && ($params['AvisoSearch']['tipo_aviso_id'] != ''))
                $query->andFilterWhere(['like', 'aviso.tipo_aviso_id', $params['AvisoSearch']['tipo_aviso_id']]);
            if(isset($params['AvisoSearch']['titulo']) && ($params['AvisoSearch']['titulo'] != ''))
                $query->andFilterWhere(['like', 'aviso.titulo', $params['AvisoSearch']['titulo']]);
//            if(isset($params['AvisoSearch']['direccion']) && ($params['AvisoSearch']['direccion'] != ''))
//                $query->andFilterWhere(['like', 'aviso.direccion', $params['AvisoSearch']['direccion']]);
            if(isset($params['AvisoSearch']['p_nombre']) && ($params['AvisoSearch']['p_nombre'] != ''))
                $query->andFilterWhere(['like', 'perro.nombre', $params['AvisoSearch']['p_nombre']]);
            if(isset($params['AvisoSearch']['p_esta_enfermo']) && ($params['AvisoSearch']['p_esta_enfermo'] != ''))
                $query->andFilterWhere(['like', 'perro.esta_enfermo', $params['AvisoSearch']['p_esta_enfermo']]);
            if(isset($params['AvisoSearch']['p_estado_clinico_id']) && ($params['AvisoSearch']['p_estado_clinico_id'] != ''))
                $query->andFilterWhere(['like', 'perro.estado_clinico_id', $params['AvisoSearch']['p_estado_clinico_id']]);
            if(isset($params['AvisoSearch']['p_tipo_pelo_id']) && ($params['AvisoSearch']['p_tipo_pelo_id'] != ''))
                $query->andFilterWhere(['like', 'perro.tipo_pelo_id', $params['AvisoSearch']['p_tipo_pelo_id']]);
            if(isset($params['AvisoSearch']['p_edad_estimada']) && ($params['AvisoSearch']['p_edad_estimada'] != ''))
                $query->andFilterWhere(['like', 'perro.edad_estimada', $params['AvisoSearch']['p_edad_estimada']]);
            if(isset($params['AvisoSearch']['p_marca_visible_detalle']) && ($params['AvisoSearch']['p_marca_visible_detalle'] != ''))
                $query->andFilterWhere(['like', 'perro.marca_visible_detalle', $params['AvisoSearch']['p_marca_visible_detalle']]);
            if(isset($params['AvisoSearch']['p_tiene_marca_visible']) && ($params['AvisoSearch']['p_tiene_marca_visible'] != ''))
                $query->andFilterWhere(['like', 'perro.tiene_marca_visible', $params['AvisoSearch']['p_tiene_marca_visible'] ]);
            if(isset($params['AvisoSearch']['p_preniada']) && ($params['AvisoSearch']['p_preniada'] != ''))
                $query->andFilterWhere(['like', 'perro.preniada', $params['AvisoSearch']['p_preniada']]);
            if(isset($params['AvisoSearch']['p_castrada']) && ($params['AvisoSearch']['p_castrada'] != ''))
                $query->andFilterWhere(['like', 'perro.castrada', $params['AvisoSearch']['p_castrada']]);
            if(isset($params['AvisoSearch']['p_tiene_collar']) && ($params['AvisoSearch']['p_tiene_collar'] != ''))
                $query->andFilterWhere(['like', 'perro.tiene_collar', $params['AvisoSearch']['p_tiene_collar']]);
            if(isset($params['AvisoSearch']['p_orejas_cortadas']) && ($params['AvisoSearch']['p_orejas_cortadas'] != ''))
                $query->andFilterWhere(['like', 'perro.orejas_cortadas', $params['AvisoSearch']['p_orejas_cortadas']]);
            if(isset($params['AvisoSearch']['p_le_faltan_miembros']) && ($params['AvisoSearch']['p_le_faltan_miembros'] != ''))
                $query->andFilterWhere(['like', 'perro.cola_cortada', $this->p_cola_cortada]);
            if(isset($params['AvisoSearch']['p_raza_id']) && ($params['AvisoSearch']['p_raza_id'] != ''))
                $query->andFilterWhere(['like', 'perro.raza_id', $params['AvisoSearch']['p_raza_id']]);
            if(isset($params['AvisoSearch']['p_sexo_id']) && ($params['AvisoSearch']['p_sexo_id'] != ''))
                $query->andFilterWhere(['like', 'perro.sexo_id', $params['AvisoSearch']['p_sexo_id']]);
            if(isset($params['AvisoSearch']['p_tamanio_id']) && ($params['AvisoSearch']['p_tamanio_id'] != ''))
                $query->andFilterWhere(['like', 'perro.tamanio_id', $params['AvisoSearch']['p_tamanio_id']]);
            if(isset($params['AvisoSearch']['p_color_primario']) && ($params['AvisoSearch']['p_color_primario'] != ''))
                $query->andFilterWhere(['like', 'perro.color_primario', $params['AvisoSearch']['p_color_primario']]);
            if(isset($params['AvisoSearch']['p_color_secundario']) && ($params['AvisoSearch']['p_color_secundario'] != ''))
                $query->andFilterWhere(['like', 'perro.color_secundario', $params['AvisoSearch']['p_color_secundario']]);
            if(isset($params['AvisoSearch']['p_estado_clinico_id']) && ($params['AvisoSearch']['p_estado_clinico_id'] != ''))
                $query->andFilterWhere(['like', 'perro.estado_clinico_id', $params['AvisoSearch']['p_estado_clinico_id']]);
            if(isset($params['AvisoSearch']['fecha_evento']) && ($params['AvisoSearch']['fecha_evento'] != '')) {
                $fechaConsulta = $this->ordenarFechaParaGuardar($params['AvisoSearch']['fecha_evento']);
                $query->andFilterWhere(['>=', 'fecha_evento', $fechaConsulta]);
            }
            if((isset($params['AvisoSearch']['a_latitud']) && ($params['AvisoSearch']['a_latitud'] != '')) &&
                (isset($params['AvisoSearch']['a_longitud']) && ($params['AvisoSearch']['a_longitud'] != ''))){
                if (isset($params['AvisoSearch']['a_latitud']) && ($params['AvisoSearch']['a_radio'] != '')) {
                    $radio = $params['AvisoSearch']['a_radio'];
                } else {
                    $radio = 100;
                }
                $query->andWhere(' (SELECT (acos(sin(radians(aviso.latitud)) * sin(radians('.$params['AvisoSearch']['a_latitud'].')) + 
                                          cos(radians(aviso.latitud)) * cos(radians('.$params['AvisoSearch']['a_latitud'].')) * 
                                          cos(radians(aviso.longitud) - radians('.$params['AvisoSearch']['a_longitud'].'))) * 6378)) <= '.$radio);
            }
        } else {
            $fechaConsulta = $this->ordenarFechaParaGuardar($this->fecha_filtro);
            $query->andFilterWhere(['>=', 'fecha_evento', $fechaConsulta]);
            $query->andFilterWhere(['or',
                ['like', 'tipo.nombre', $this->keyword],
                ['like', 'aviso.titulo', $this->keyword],
                ['like', 'aviso.direccion', $this->keyword],
                ['like', 'aviso.informacion', $this->keyword],
                ['like', 'perro.nombre', $this->keyword],
                ['like', 'perro.marca_visible_detalle', $this->keyword],
                ['like', 'raza.nombre', $this->keyword],
                ['like', 'estado_clinico.nombre', $this->keyword],
                ['like', 'sexo.nombre', $this->keyword],
                ['like', 'tamanio.nombre', $this->keyword],
                ['like', 'color.nombre', $this->keyword],
                ['like', 'estado_clinico.nombre', $this->keyword],
            ]);
        }

        return $dataProvider;
    }
}
