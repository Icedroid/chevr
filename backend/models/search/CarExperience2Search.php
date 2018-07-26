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
class CarExperience2Search extends CarExperience
{
    public $car_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id', 'car_id', 'agency_id', 'item_1', 'item_2', 'item_11', 'item_12', 'item_13', 'item_14', 'item_15',
//                'item_16'], 'integer'],
//            [['created_at', 'updated_at'], 'string'],
            [['car_name'], 'string'],
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
        return [];
//        return [
//            [
//                'class' => TimeSearchBehavior::className(),
//                'timeAttributes' => ['{{car_experience}}.created_at'=>'created_at'],
//            ],
//        ];
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
        $query = CarExperience::find()->select(['MIN({{car_experience}}.car_id) AS car_id , MIN({{car_experience}}.agency_id) AS agency_id',
            'COUNT({{car_experience}}.id) AS count',
            'SUM({{car_experience}}.item_11) AS item_11',
            'SUM({{car_experience}}.item_12) AS item_12',
            'SUM({{car_experience}}.item_13) AS item_13',
            'SUM({{car_experience}}.item_14) AS item_14',
            'SUM({{car_experience}}.item_15) AS item_15',
            'SUM({{car_experience}}.item_16) AS item_16',
            'SUM({{car_experience}}.item_2) AS item_2',
            '{{car_info}}.name', '{{car_agency}}.store_name'])->with('carAgency')
            ->groupBy('{{car_experience}}.agency_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
//                    'sort' => SORT_ASC,
                    'car_id' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if(!$this->car_name){//default filter
            $this->car_id = 1;
        }

        $query->joinWith(['carInfo', 'carAgency'])
            ->andFilterWhere(['{{car_info}}.name'=>$this->car_name])
            ->andFilterWhere(['car_id'=>$this->car_id]);

//        var_dump($dataProvider);
        $this->trigger(SearchEvent::BEFORE_SEARCH, new SearchEvent(['query' => $query]));
        return $dataProvider;
    }
}
