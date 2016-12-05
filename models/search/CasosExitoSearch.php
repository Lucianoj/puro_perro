<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CasosExito;

/**
 * CasosExitoSearch represents the model behind the search form about `app\models\CasosExito`.
 */
class CasosExitoSearch extends CasosExito
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aviso_id', 'perro_id', 'created_by', 'updated_by'], 'integer'],
            [['mensaje', 'created_at', 'updated_at', 'foto_reencuentro', 'perro.nombre', 'aviso.titulo', 'user.apodo'], 'safe'],
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
        $query = CasosExito::find();

        // add conditions that should always apply here

        $query->innerJoin(['aviso'], 'aviso.id = casos_exito.aviso_id');
        $query->innerJoin(['perro'], 'perro.id = casos_exito.perro_id');
        $query->innerJoin(['user'], 'user.id = casos_exito.created_by');


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
                'mensaje',
                'aviso.titulo',
                'user.apodo',
                'perro.nombre',
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'aviso_id' => $this->aviso_id,
            'perro_id' => $this->perro_id,
            'casos_exito.created_by' => $this->created_by,
            'casos_exito.created_at' => $this->created_at,
            'casos_exito.updated_at' => $this->updated_at,
            'casos_exito.updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'aviso.titulo', $this->getAttribute('aviso.titulo')]);
        $query->andFilterWhere(['like', 'perro.nombre', $this->getAttribute('perro.nombre')]);

        $query->andFilterWhere(['like', 'mensaje', $this->mensaje]);
//            ->andFilterWhere(['like', 'foto_reencuentro', $this->foto_reencuentro]);

        return $dataProvider;
    }
}
