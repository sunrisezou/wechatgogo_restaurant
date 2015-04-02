<?php

namespace app\models\searches;

use app\models\User;
use yii\data\ActiveDataProvider;

class GeneralUserSearch extends User
{
    public $restaurantNameEnCa;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantNameEnCa', 'username', 'name', 'email', 'phone', 'user_group', 'active'], 'safe'],
        ];
    }

    /**
     * @param $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()->joinWith('restaurant');

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
                'user_id' => SORT_ASC,
            ],
        ]);

        $dataProvider->sort->attributes['restaurantNameEnCa'] = [
            'asc'   => ['restaurant.name_en_ca' => SORT_ASC],
            'desc'  => ['restaurant.name_en_ca' => SORT_DESC],
            'label' => 'Restaurant'
        ];

        $dataProvider->setPagination([
            'pageSize' => 10,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['user_group' => $this->user_group])
            ->andFilterWhere(['active' => $this->active])
            ->andFilterWhere(['like', 'restaurant.name_en_ca', $this->restaurantNameEnCa]);


        return $dataProvider;
    }
}