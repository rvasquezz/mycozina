<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\SeguridadUsuarios;

/**
 * SeguridadUsuariosSearch represents the model behind the search form about `app\modules\admin\models\SeguridadUsuarios`.
 */

class SeguridadUsuariosSearch extends SeguridadUsuarios
{
public $nombres;
public $apellidos;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'integer'],
            [['login', 'password','apellidos', 'nombres'], 'safe'],
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
        $query = SeguridadUsuarios::find();
        $query->joinWith(['persona0']);
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
            'id_usuario' => $this->id_usuario
        ]);

        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'password', $this->password]);
       

        return $dataProvider;
    }
}
