<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\UsuarioGrupo;

/**
 * UsuarioGrupoSearch represents the model behind the search form about `app\modules\admin\models\UsuarioGrupo`.
 */
class UsuarioGrupoSearch extends UsuarioGrupo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_grupo', 'id_usuario'], 'safe'],
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
        $query = UsuarioGrupo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith("idGrupo");
        $query->joinWith("idUsuario");

        
        $query->andFilterWhere(['like', 'grupo.nombre', $this->id_grupo])
            ->andFilterWhere(['like', 'usuario.login', $this->id_usuario]);

        return $dataProvider;
    }
}
