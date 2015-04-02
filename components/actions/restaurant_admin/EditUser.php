<?php

namespace app\components\actions\restaurant_admin;

use Yii;
use app\models\forms\UserProfileForm;
use yii\web\BadRequestHttpException;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class EditUser extends \yii\base\Action
{
    public function run($userId)
    {
        $restaurantId = Yii::$app->user->identity->restaurant_id;

        // Make sure that the target user and the current user belong to the same restaurant.
        $userProfileForm = UserProfileForm::findOne([
            'restaurant_id' => $restaurantId,
            'user_id'       => $userId,
        ]);

        if (empty($userProfileForm)) {
            throw new BadRequestHttpException;
        }

        /* @var $userProfileForm \app\models\forms\UserProfileForm */
        $userProfileForm->scenario = UserProfileForm::SCENARIO_UPDATE_BY_MANAGER;

        if (Yii::$app->getRequest()->isAjax && $userProfileForm->load(Yii::$app->getRequest()->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($userProfileForm);
        }

        if ($userProfileForm->load(Yii::$app->getRequest()->post()) && $userProfileForm->updateUser()) {

            return $this->controller->redirect(['restaurant-admin/users']);
        }

        return $this->controller->render('edit-user',[
            'userProfileForm' => $userProfileForm,
        ]);
    }
}