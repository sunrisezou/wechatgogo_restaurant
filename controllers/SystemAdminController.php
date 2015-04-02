<?php

namespace app\controllers;

use app\components\access_rules\GroupBasedAccessRule;
use app\components\AppConstant;
use app\models\User;
use Yii;
use yii\filters\AccessControl;

class SystemAdminController extends \app\components\base\AppBaseController
{
    /**
     * @inheritdoc
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        if (empty($behaviors)) {
            $behaviors = [];
        }

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'class'         => GroupBasedAccessRule::className(),
                    'allowedGroups' => [AppConstant::USER_GROUP_ADMIN],
                    'actions'       => [
                        'users', 'add-user', 'edit-user', 'change-user-password',
                        'restaurants', 'add-restaurant', 'edit-restaurant',
                    ]
                ],
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        return [
            'users'                => \app\components\actions\system_admin\Users::className(),
            'add-user'             => \app\components\actions\system_admin\AddUser::className(),
            'edit-user'            => \app\components\actions\system_admin\EditUser::className(),
            'change-user-password' => \app\components\actions\system_admin\ChangeUserPassword::className(),
            'restaurants'          => \app\components\actions\system_admin\Restaurants::className(),
            'add-restaurant'       => \app\components\actions\system_admin\AddRestaurant::className(),
            'edit-restaurant'      => \app\components\actions\system_admin\EditRestaurant::className(),
        ];
    }
}