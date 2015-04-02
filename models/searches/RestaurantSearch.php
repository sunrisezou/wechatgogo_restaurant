<?php

namespace app\models\searches;

use Yii;
use app\models\Restaurant;
use yii\data\ActiveDataProvider;

class RestaurantSearch extends Restaurant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id','name_en_ca','name_zh_cn','name_zh_tw','active'],'safe'],
        ];
    }

    /**
     * @param $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Restaurant::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params)
         * statement below
         */
        $dataProvider->setSort([
            'defaultOrder' => [
                'restaurant_id' => SORT_ASC,
            ],
        ]);

        $dataProvider->setPagination([
            'pageSize' => 10,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name_en_ca', $this->name_en_ca])
            ->andFilterWhere(['like', 'name_zh_cn', $this->name_zh_cn])
            ->andFilterWhere(['like', 'name_zh_tw', $this->name_zh_tw])
            ->andFilterWhere(['active' => $this->active]);

        return $dataProvider;
    }
}