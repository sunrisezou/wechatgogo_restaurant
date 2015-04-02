<?php

namespace app\controllers;

use app\components\access_rules\GroupBasedAccessRule;
use app\components\AppConstant;
use Yii;
use yii\filters\AccessControl;

class RestaurantAdminController extends \app\components\base\AppBaseController
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
                    'allowedGroups' => [AppConstant::USER_GROUP_MANAGER],
                    'actions'       => [
                        'tables', 'activate-table', 'deactivate-table', 'add-table', 'edit-table',
                        'users', 'add-user', 'edit-user', 'change-user-password',
                    ]
                ],
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        return [
            'tables'               => \app\components\actions\restaurant_admin\Tables::className(),
            'activate-table'       => \app\components\actions\restaurant_admin\ActivateTable::className(),
            'deactivate-table'     => \app\components\actions\restaurant_admin\DeactivateTable::className(),
            'add-table'            => \app\components\actions\restaurant_admin\AddTable::className(),
            'edit-table'           => \app\components\actions\restaurant_admin\EditTable::className(),
            'users'                => \app\components\actions\restaurant_admin\Users::className(),
            'add-user'             => \app\components\actions\restaurant_admin\AddUser::className(),
            'edit-user'            => \app\components\actions\restaurant_admin\EditUser::className(),
            'change-user-password' => \app\components\actions\restaurant_admin\ChangeUserPassword::className(),
        ];
    }
}