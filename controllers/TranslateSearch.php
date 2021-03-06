<?php

namespace infun3\translator\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * TranslateSearch represents the model behind the search form about `app\models\TranslateSearch`.
 */
class TranslateSearch extends Translate
{
    /**
     * @inheritdoc
     */
    public $directions;
    public function rules()
    {
        return [
            [['id', 'user_id', 'alert'], 'integer'],
            [['str'], 'safe'],
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
        $query = Translate::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'alert' => $this->alert,
        ]);

        $query->andFilterWhere(['like', 'str', $this->str]);

        return $dataProvider;
    }
}
