<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'telefono_fijo', 'telefono_celular', 'localidad_id', 'estado_usuario_id', 'tipo_usuario_id', 'rol_id', 'desea_adoptar', 'ofrece_transito'], 'integer'],
            [['apodo', 'nombre', 'apellido', 'domicilio', 'email', 'auth_key', 'password_hash', 'password_reset_token', 'created_at', 'updated_at'], 'safe'],
            [['latitud', 'longitud'], 'number'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'telefono_fijo' => $this->telefono_fijo,
            'telefono_celular' => $this->telefono_celular,
            'localidad_id' => $this->localidad_id,
            'estado_usuario_id' => $this->estado_usuario_id,
            'tipo_usuario_id' => $this->tipo_usuario_id,
            'rol_id' => $this->rol_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'desea_adoptar' => $this->desea_adoptar,
            'ofrece_transito' => $this->ofrece_transito,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
        ]);

        $query->andFilterWhere(['like', 'apodo', $this->apodo])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'domicilio', $this->domicilio])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token]);

        return $dataProvider;
    }
}
