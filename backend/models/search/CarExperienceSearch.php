<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CarExperience;
use backend\behaviors\TimeSearchBehavior;
use backend\components\search\SearchEvent;

/**
 * CarExperienceSearch represents the model behind the search form about `backend\models\CarExperience`.
 */
class CarExperienceSearch extends CarExperience
{
    public $car_name;
    public $account_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'car_id', 'agency_id', 'item_1', 'item_2', 'item_11', 'item_12', 'item_13', 'item_14', 'item_15',
                'item_16'], 'integer'],
            [['created_at', 'updated_at'], 'string'],
            [['car_name', 'account_name'], 'string'],
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

    public function behaviors()
    {
        return [
            TimeSearchBehavior::className()
        ];
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
        $query = CarExperience::find()->with('carAgency', 'carInfo');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
//                    'sort' => SORT_ASC,
                    'id' => SORT_DESC,
                ]
            ]
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
            'car_id' => $this->car_id,
            'agency_id' => $this->agency_id,
            'item_1' => $this->item_1,
            'item_2' => $this->item_2,
            'item_11' => $this->item_11,
            'item_12' => $this->item_12,
            'item_13' => $this->item_13,
            'item_14' => $this->item_14,
            'item_15' => $this->item_15,
            'item_16' => $this->item_16,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->joinWith(['carInfo A', 'carAgency B'])
            ->andFilterWhere(['like', 'A.name', $this->car_name])
            ->andFilterWhere(['like', 'B.account_name', $this->account_name]);

        $this->trigger(SearchEvent::BEFORE_SEARCH, new SearchEvent(['query'=>$query]));
        return $dataProvider;
    }
}
