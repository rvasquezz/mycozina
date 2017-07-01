<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Controlador;

/**
 * ControladorSearch represents the model behind the search form about `app\modules\admin\models\Controlador`.
 */
class ControladorSearch extends Controlador
{
    /**
     * @inheritdoc
     */
    public $acciones;
    public $descripcion_modulo;
    public function rules()
    {
        return [
            [['id_controlador', 'id_modulo'], 'integer'],
            [['descripcion','descripcion_modulo'], 'safe'],
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
        $query = Controlador::find();
        $query->joinWith(['idModulo']);
        // $query->innerJoin(['seguridad.modulo','modulo.id_modulo=controlador.id_modulo']);
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
            'id_controlador' => $this->id_controlador,
            'id_modulo' => $this->id_modulo,
        ]);

        $query->andFilterWhere(['like', 'controlador.descripcion', $this->descripcion])
        ->andFilterWhere(['like', 'modulo.descripcion', $this->descripcion_modulo]);

        return $dataProvider;
    }
}
