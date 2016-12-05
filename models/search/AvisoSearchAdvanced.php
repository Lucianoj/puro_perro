<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 29/11/16
 * Time: 17:12
 */

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aviso;

/**
 * AvisoSearchAdvanced represents the model behind the search form about `app\models\Aviso`.
 */
class AvisoSearchAdvanced extends Aviso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_aviso_id', 'estado_aviso_id', 'created_by', 'perro_id', 'updated_by'], 'integer'],
            [['titulo', 'created_at', 'updated_at', 'direccion', 'informacion', 'user.apodo','estado.nombre', 'tipo.nombre', 'perro.nombre'], 'safe'],
            [['latitud', 'longitud'], 'number'],
            [['informacion', 'keyword'], 'string'],
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
        $query = Aviso::find();

        // add conditions that should always apply here

        $query->innerJoin(['estado_aviso as estado'], 'estado.id = aviso.estado_aviso_id');
        $query->innerJoin(['user'], 'user.id = aviso.created_by');
        $query->innerJoin(['perro'], 'perro.id = aviso.perro_id');
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
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'aviso.created_at' => $this->created_at,
            'aviso.created_by' => $this->created_by,
            'aviso.updated_at' => $this->updated_at,
            'aviso.updated_by' => $this->updated_by,
        ]);



        $query->andFilterWhere(['or like', 'tipo.nombre',[$this->getAttribute('tipo.nombre'), $this->keyword]]);
//                                    ['or like', 'tipo.nombre', ],
//                                    ['like', 'tipo.nombre', ],
//                                ]);
        $query->andFilterWhere(['or',
            ['like', 'perro.nombre', $this->getAttribute('perro.nombre')],
            ['like', 'perro.nombre', $this->keyword],
        ]);
        $query->andFilterWhere(['or',
            ['like', 'estado.nombre', $this->getAttribute('estado.nombre')],
            ['like', 'estado.nombre', $this->keyword],
        ]);
        $query->andFilterWhere(['or',
            ['like', 'user.apodo', $this->getAttribute('user.apodo')],
            ['like', 'user.apodo', $this->keyword],
        ]);
        $query->andFilterWhere(['or like', 'aviso.titulo',[$this->titulo, $this->keyword]]);
//        $query->andFilterWhere(['or',
//                                    ['like', 'aviso.titulo', $this->titulo],
//                                    ['like', 'aviso.titulo', $this->keyword],
//                                ]);

        $query->andFilterWhere(['or',
            ['like', 'aviso.direccion', $this->direccion],
            ['like', 'aviso.direccion', $this->keyword],
        ]);
        $query->andFilterWhere(['or',
            ['like', 'aviso.informacion', $this->informacion],
            ['like', 'aviso.informacion', $this->keyword],
        ]);

        return $dataProvider;
    }
}
