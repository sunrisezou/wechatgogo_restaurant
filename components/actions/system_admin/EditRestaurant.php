<?php

namespace app\components\actions\system_admin;

use app\models\forms\RestaurantProfileForm;
use Yii;
use yii\web\BadRequestHttpException;

class EditRestaurant extends \yii\base\Action
{
    public function run($restaurantId)
    {
        $restaurantProfileForm = RestaurantProfileForm::findOne($restaurantId);

        if (empty($restaurantProfileForm)) {
            throw new BadRequestHttpException;
        }

        /* @var $restaurantProfileForm \app\models\forms\RestaurantProfileForm */
        $restaurantProfileForm->scenario = RestaurantProfileForm::SCENARIO_UPDATE_BY_ADMIN;

        if ($restaurantProfileForm->load(Yii::$app->getRequest()->post()) && $restaurantProfileForm->saveForm()) {

            return $this->controller->redirect(['/system-admin/restaurants']);
        }

        return $this->controller->render('edit-restaurant', [
            'restaurantProfileForm' => $restaurantProfileForm,
        ]);
    }
}