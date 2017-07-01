<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Acciones;

/**
 * AccionesSearch represents the model behind the search form about `app\modules\admin\models\Acciones`.
 */
class AccionesSearch extends Acciones
{
    /**
     * @inheritdoc
     */
    public $descripcion_controlador;
    public function rules()
    {
        return [
            [['id_accion', 'id_controlador'], 'integer'],
            [['descripcion','descripcion_controlador'], 'safe'],
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
        $query = Acciones::find();
        $query->joinWith(['idControlador']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_accion' => $this->id_accion,
            'id_controlador' => $this->id_controlador,
        ]);

        $query->andFilterWhere(['like', 'acciones.descripcion', $this->descripcion])
        ->andFilterWhere(['like', 'controlador.descripcion', $this->descripcion_controlador]);

        return $dataProvider;
    }
}
