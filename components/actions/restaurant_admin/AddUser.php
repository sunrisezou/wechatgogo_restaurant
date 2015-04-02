<?php

namespace app\components\actions\restaurant_admin;

use Yii;
use app\models\forms\UserProfileForm;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class AddUser extends \yii\base\Action
{
    public function run()
    {
        $userProfileForm = new UserProfileForm();
        $userProfileForm->scenario = UserProfileForm::SCENARIO_CREATE_BY_MANAGER;
        $restaurantId = Yii::$app->user->identity->restaurant_id;

        if (Yii::$app->getRequest()->isAjax && $userProfileForm->load(Yii::$app->getRequest()->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($userProfileForm);
        }

        if ($userProfileForm->load(Yii::$app->getRequest()->post()) && $userProfileForm->createUser($restaurantId)) {

            return $this->controller->redirect(['/restaurant-admin/users']);
        }

        $userProfileForm->plainTextPassword = '';
        $userProfileForm->plainTextPasswordConfirm = '';

        return $this->controller->render('add-user',[
            'userProfileForm' => $userProfileForm,
        ]);
    }
}