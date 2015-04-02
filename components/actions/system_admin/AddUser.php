<?php

namespace app\components\actions\system_admin;

use Yii;
use app\models\forms\UserProfileForm;
use yii\bootstrap\ActiveForm;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class AddUser extends \yii\base\Action
{
    public function run()
    {
        $userProfileForm = new UserProfileForm();
        $userProfileForm->scenario = UserProfileForm::SCENARIO_CREATE_BY_ADMIN;

        if (Yii::$app->getRequest()->isAjax && $userProfileForm->load(Yii::$app->getRequest()->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($userProfileForm);
        }

        if ($userProfileForm->load(Yii::$app->getRequest()->post()) && $userProfileForm->createUser()) {

            return $this->controller->redirect(['/system-admin/users']);
        }

        $userProfileForm->plainTextPassword = '';
        $userProfileForm->plainTextPasswordConfirm = '';

        $restaurantOptions = $this->_getRestaurantOptions();

        return $this->controller->render('add-user', [
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