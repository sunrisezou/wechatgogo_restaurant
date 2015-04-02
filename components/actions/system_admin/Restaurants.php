<?php

namespace app\components\actions\system_admin;

use app\models\searches\RestaurantSearch;
use Yii;

class Restaurants extends \yii\base\Action
{
    public function run()
    {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->get());

        return $this->controller->render('restaurants', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}