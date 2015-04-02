<?php

namespace app\components\actions\restaurant_admin;

use app\components\AppConstant;
use app\models\forms\UserPasswordForm;
use app\models\User;
use Yii;

class ChangeUserPassword extends \yii\base\Action
{
    public function run($userId)
    {
        $restaurantId = Yii::$app->user->identity->restaurant_id;

        // Make sure that the target user and the current user belong to the same restaurant and the target user
        // is not in manager group.
        $user = User::find()->where([
            'restaurant_id' => $restaurantId,
            'user_id'       => $userId,
        ])->andWhere(['not', ['user_group' => AppConstant::USER_GROUP_MANAGER]])
        ->limit(1)->one();

        if (empty($user)) {
            throw new BadRequestHttpException;
        }

        /* @var $user \app\models\User */
        $userPasswordForm = new UserPasswordForm();

        if ($userPasswordForm->load(Yii::$app->getRequest()->post()) && $userPasswordForm->updatePassword($user)) {

            return $this->controller->redirect(['/restaurant-admin/users']);
        }

        return $this->controller->render('change-user-password', [
            'userPasswordForm' => $userPasswordForm,
            'user'             => $user,
        ]);
    }
}