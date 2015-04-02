<?php

namespace app\models\searches;

use app\components\AppConstant;
use app\models\User;
use yii\data\ActiveDataProvider;

class RestaurantUserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'email', 'phone', 'user_group', 'active'], 'safe'],
        ];
    }

    /**
     * @param $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$restaurantId)
    {
        $query = User::find()
            ->where(['restaurant_id' => $restaurantId])
            ->andWhere(['not',['user_group' => AppConstant::USER_GROUP_MANAGER]]);

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
            ->andFilterWhere(['active' => $this->active]);

        return $dataProvider;
    }
}