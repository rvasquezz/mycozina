<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\AccionGrupo;

/**
 * AccionGrupoSearch represents the model behind the search form about `app\modules\admin\models\AccionGrupo`.
 */
class AccionGrupoSearch extends AccionGrupo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_accion', 'id_controlador', 'id_grupo'], 'integer'],
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
        $query = AccionGrupo::find();

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
            'id_grupo' => $this->id_grupo,
        ]);

        return $dataProvider;
    }
}
