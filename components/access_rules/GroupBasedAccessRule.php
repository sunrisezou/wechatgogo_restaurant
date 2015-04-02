<?php

namespace app\components\access_rules;

use Yii;

class GroupBasedAccessRule extends \yii\filters\AccessRule
{

    public $allowedGroups;

    public function init()
    {
        parent::init();
        $this->allow = true;
        $this->roles = ['@'];
        $this->matchCallback = [$this, 'checkUserGroup'];
    }

    public function checkUserGroup()
    {
        $currentUserGroup = Yii::$app->user->identity->user_group;

        if (!in_array($currentUserGroup,$this->allowedGroups)) {
            return false;
        }

        return true;
    }
}
