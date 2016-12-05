<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Adoptante;

/**
 * AdoptanteSearch represents the model behind the search form about `app\models\Adoptante`.
 */
class AdoptanteSearch extends Adoptante
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'estado_adoptante_id', 'tiene_otros_perros', 'tiene_ninios', 'tiene_patio_cerrado', 'tiene_gatos', 'deja_casa_sola_muchas_horas', 'puede_atender_mascota_enferma', 'acepta_visitas_de_control'], 'integer'],
            [['comentarios' , 'nota_admin', 'user.apodo', 'estado.nombre'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Adoptante::find();

        // add conditions that should always apply here

        $query->innerJoin(['estado_adoptante as estado'], 'estado.id = adoptante.estado_adoptante_id');
        $query->innerJoin(['user'], 'user.id = adoptante.user_id');

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
                'estado.nombre',
                'user.apodo',
                'comentarios',
                'nota_admin',
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'estado_adoptante_id' => $this->estado_adoptante_id,
            'tiene_otros_perros' => $this->tiene_otros_perros,
            'tiene_ninios' => $this->tiene_ninios,
            'tiene_patio_cerrado' => $this->tiene_patio_cerrado,
            'tiene_gatos' => $this->tiene_gatos,
            'deja_casa_sola_muchas_horas' => $this->deja_casa_sola_muchas_horas,
            'puede_atender_mascota_enferma' => $this->puede_atender_mascota_enferma,
            'acepta_visitas_de_control' => $this->acepta_visitas_de_control,
        ]);

        $query->andFilterWhere(['like', 'comentarios', $this->comentarios]);
        $query->andFilterWhere(['like', 'nota_admin', $this->nota_admin]);
        $query->andFilterWhere(['like', 'estado.nombre', $this->getAttribute('estado.nombre')]);
        $query->andFilterWhere(['like', 'user.apodo', $this->getAttribute('user.apodo')]);

        return $dataProvider;
    }
}
