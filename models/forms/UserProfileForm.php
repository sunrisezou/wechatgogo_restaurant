<?php

namespace app\models\forms;

use app\components\AppConstant;
use Yii;

class UserProfileForm extends \app\models\User
{
    const SCENARIO_CREATE_BY_MANAGER = 'create_by_manager';
    const SCENARIO_UPDATE_BY_MANAGER = 'update_by_manager';
    const SCENARIO_CREATE_BY_ADMIN = 'create_by_admin';
    const SCENARIO_UPDATE_BY_ADMIN = 'update_by_admin';

    public $plainTextPassword;
    public $plainTextPasswordConfirm;

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE_BY_MANAGER] = [
            'username', 'plainTextPassword', 'plainTextPasswordConfirm', 'name', 'email', 'phone', 'user_group'
        ];
        $scenarios[self::SCENARIO_UPDATE_BY_MANAGER] = [
            'username', 'name', 'email', 'phone', 'user_group', 'active'
        ];
        $scenarios[self::SCENARIO_CREATE_BY_ADMIN] = [
            'restaurant_id', 'username', 'plainTextPassword', 'plainTextPasswordConfirm',
            'name', 'email', 'phone', 'user_group'
        ];
        $scenarios[self::SCENARIO_UPDATE_BY_ADMIN] = [
            'restaurant_id', 'username', 'name', 'email', 'phone', 'user_group', 'active'
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'username', 'plainTextPassword', 'plainTextPasswordConfirm',
                'name', 'user_group', 'active'], 'required'],
            ['restaurant_id', 'integer', 'min' => 0],
            [['username', 'plainTextPassword', 'plainTextPasswordConfirm', 'name', 'email'], 'trim'],
            ['username', 'unique'],
            ['username', 'string', 'length' => [6, 200]],
            ['username', 'match', 'pattern' => '/^[a-z0-9]+$/',
                                  'message' => Yii::t('app', 'Digits and lower case letters only.')],
            ['plainTextPassword', 'string', 'min' => 8],
            ['plainTextPasswordConfirm', 'compare', 'compareAttribute' => 'plainTextPassword'],
            ['name', 'string', 'length' => [2, 200]],
            ['email', 'email'],
            ['email', 'string', 'length' => [3, 200]],
            ['phone', 'string', 'max' => 20],
            ['user_group', 'in', 'range' => [
                AppConstant::USER_GROUP_MANAGER,
                AppConstant::USER_GROUP_COOK,
                AppConstant::USER_GROUP_WAITER
            ], 'on'                      => [self::SCENARIO_CREATE_BY_ADMIN, self::SCENARIO_UPDATE_BY_ADMIN]],
            ['user_group', 'in', 'range' => [
                AppConstant::USER_GROUP_COOK,
                AppConstant::USER_GROUP_WAITER
            ], 'on'                      => [self::SCENARIO_CREATE_BY_MANAGER, self::SCENARIO_UPDATE_BY_MANAGER]],
            ['active', 'in', 'range' => [0, 1]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['plainTextPassword'] = Yii::t('app', 'Password');
        $labels['plainTextPasswordConfirm'] = Yii::t('app', 'Confirm Password');

        return $labels;
    }

    /**
     * Create a new user record in the database.
     *
     * @param $restaurantId
     *
     * @return bool Whether the user was created successfully.
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function createUser($restaurantId = null)
    {
        if (!$this->validate()) {

            return false;
        }

        if ($restaurantId != null) {
            $this->restaurant_id = $restaurantId;
        }

        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->plainTextPassword);
        $this->access_token = Yii::$app->getSecurity()->generateRandomString();
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
        $this->active = 1;

        return $this->save(false);
    }

    /**
     *
     *
     * @param null $restaurantId
     *
     * @return bool
     */
    public function updateUser($restaurantId = null)
    {
        if (!$this->validate()) {

            return false;
        }

        if ($restaurantId != null) {
            $this->restaurant_id = $restaurantId;
        }

        return $this->save(false);
    }

}