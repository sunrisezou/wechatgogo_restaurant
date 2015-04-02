<?php

namespace app\components\actions\system_admin;

use app\models\forms\UserPasswordForm;
use app\models\User;
use Yii;

class ChangeUserPassword extends \yii\base\Action
{
    public function run($userId)
    {
        $user = User::findOne([
            'user_id'       => $userId,
        ]);

        if (empty($user)) {
            throw new BadRequestHttpException;
        }

        /* @var $user \app\models\User */
        $userPasswordForm = new UserPasswordForm();

        if ($userPasswordForm->load(Yii::$app->getRequest()->post()) && $userPasswordForm->updatePassword($user)) {

            return $this->controller->redirect(['/system-admin/users']);
        }

        return $this->controller->render('change-user-password', [
            'userPasswordForm' => $userPasswordForm,
            'user'             => $user,
        ]);
    }
}