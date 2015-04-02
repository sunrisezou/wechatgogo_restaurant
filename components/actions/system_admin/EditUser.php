<?php

namespace app\components\actions\system_admin;

use Yii;
use app\models\forms\UserProfileForm;
use yii\web\BadRequestHttpException;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class EditUser extends \yii\base\Action
{
    public function run($userId)
    {
        $userProfileForm = UserProfileForm::findOne([
            'user_id' => $userId,
        ]);

        if (empty($userProfileForm)) {
            throw new BadRequestHttpException;
        }

        /* @var $userProfileForm \app\models\forms\UserProfileForm */
        $userProfileForm->scenario = UserProfileForm::SCENARIO_UPDATE_BY_ADMIN;

        if (Yii::$app->getRequest()->isAjax && $userProfileForm->load(Yii::$app->getRequest()->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($userProfileForm);
        }

        if ($userProfileForm->load(Yii::$app->getRequest()->post()) && $userProfileForm->updateUser()) {

            return $this->controller->redirect(['system-admin/users']);
        }

        $restaurantOptions = $this->_getRestaurantOptions();

        return $this->controller->render('edit-user', [
            'userProfileForm'   => $userProfileForm,
            'restaurantOptions' => $restaurantOptions,
        ]);
    }

    /**
     * Get an associative array of all available restaurants, of which the key is restaurant_id and the value is the
     * name of the restaurant in en-CA.
     *
     * @return array
     */
    protected function _getRestaurantOptions()
    {
        $queryResult = (new Query())->select('restaurant_id,name_en_ca')
            ->from('restaurant')
            ->orderBy('name_en_ca ASC')
            ->where(['not', ['restaurant_id' => 0]])
            ->all();

        return ArrayHelper::map($queryResult, 'restaurant_id', 'name_en_ca');
    }
}