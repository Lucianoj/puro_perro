<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Perro;

/**
 * PerroSearch represents the model behind the search form about `app\models\Perro`.
 */
class PerroSearch extends Perro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado_perro_id', 'estado_clinico_id', 'color_primario', 'color_secundario', 'raza_id', 'tamanio_id', 'tiene_collar', 'esta_enfermo', 'tiene_marca_visible', 'le_faltan_miembros', 'tipo_pelo_id', 'created_by', 'updated_by'], 'integer'],
            [['nombre', 'user.apodo','estado_perro.nombre', 'estado_clinico.nombre', 'raza.nombre', 'marca_visible_detalle'], 'safe'],
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
        $query = Perro::find();

        // add conditions that should always apply here

        $query->innerJoin(['estado_clinico'], 'estado_clinico.id = perro.estado_clinico_id');
        $query->innerJoin(['estado_perro'], 'estado_perro.id = perro.estado_perro_id');
        $query->innerJoin(['user'], 'user.id = perro.created_by');
        $query->innerJoin(['raza'], 'raza.id = perro.raza_id');

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
                'estado_clinico.nombre',
                'raza.nombre',
                'created_at',
                'user.apodo',
                'estado_perro.nombre',
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'estado_perro_id' => $this->estado_perro_id,
            'estado_clinico_id' => $this->estado_clinico_id,
            'color_primario' => $this->color_primario,
            'color_secundario' => $this->color_secundario,
            'raza_id' => $this->raza_id,
            'tamanio_id' => $this->tamanio_id,
            'tiene_collar' => $this->tiene_collar,
            'esta_enfermo' => $this->esta_enfermo,
            'tiene_marca_visible' => $this->tiene_marca_visible,
            'le_faltan_miembros' => $this->le_faltan_miembros,
            'tipo_pelo_id' => $this->tipo_pelo_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'estado_clinico.nombre', $this->getAttribute('estado_clinico.nombre')]);
        $query->andFilterWhere(['like', 'raza.nombre', $this->getAttribute('raza.nombre')]);
        $query->andFilterWhere(['like', 'estado_perro.nombre', $this->getAttribute('estado_perro.nombre')]);
        $query->andFilterWhere(['like', 'user.apodo', $this->getAttribute('user.apodo')]);
        $query->andFilterWhere(['like', 'perro.nombre', $this->nombre])
            ->andFilterWhere(['like', 'marca_visible_detalle', $this->marca_visible_detalle]);

        return $dataProvider;
    }
}
