<?php

namespace app\components\actions\system_admin;

use app\models\forms\RestaurantProfileForm;
use Yii;

class AddRestaurant extends \yii\base\Action
{
    public function run()
    {
        $restaurantProfileForm = new RestaurantProfileForm();
        $restaurantProfileForm->scenario = RestaurantProfileForm::SCENARIO_CREATE_BY_ADMIN;
        $restaurantProfileForm->active = 1;

        if ($restaurantProfileForm->load(Yii::$app->getRequest()->post()) && $restaurantProfileForm->saveForm()) {

            return $this->controller->redirect(['/system-admin/restaurants']);
        }

        return $this->controller->render('add-restaurant', [
            'restaurantProfileForm' => $restaurantProfileForm,
        ]);
    }
}