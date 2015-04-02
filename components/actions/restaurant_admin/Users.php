<?php

namespace app\components\actions\restaurant_admin;

use app\models\searches\RestaurantUserSearch;
use Yii;

class Users extends \yii\base\Action
{
    public function run()
    {
        $restaurantId = Yii::$app->user->identity->restaurant_id;
        $searchModel = new RestaurantUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->get(), $restaurantId);

        return $this->controller->render('users', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}