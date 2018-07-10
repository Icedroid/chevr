<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

namespace backend\models\search;

use backend\behaviors\TimeSearchBehavior;
use backend\components\search\SearchEvent;
use backend\models\CarAgency;
use common\models\CarAgency as CommonCarAgency;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CarAgencySearch extends CarAgency
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_login_time', 'created_at', 'updated_at'], 'string'],
            [['position_code', 'position_id', 'position_name', 'sale_code', 'service_code', 'store_name', 'store_short_name', 'area', 'province', 'city', 'access_token'], 'string'],
            [['account_code', 'account_name', 'mobile'], 'string'],
            [['id', 'brand_code', 'doss_brand_id', 'store_code', 'login_count', 'status'], 'integer'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function behaviors()
    {
        return [
            [
                'class'=>TimeSearchBehavior::className(),
                'timeAttributes' => ['last_login_time']
            ]
        ];
    }

    /**
     * @param $params
     * @param int $type
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params)
    {
        $query = CommonCarAgency::find()->select([]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);
        $this->load($params);
        if (! $this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'account_name', $this->account_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'position_name', $this->position_name])
            ->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['account_code' => $this->account_code])
            ->andFilterWhere(['access_token' => $this->access_token])
            ->andFilterWhere(['status' => $this->status]);

        $this->trigger(SearchEvent::BEFORE_SEARCH, new SearchEvent(['query'=>$query]));
        return $dataProvider;
    }

}