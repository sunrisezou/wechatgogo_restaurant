<?php

namespace app\components\actions\system_admin;

use Yii;
use app\models\searches\GeneralUserSearch;

class Users extends \yii\base\Action
{
    public function run()
    {
        $searchModel = new GeneralUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->get());

        return $this->controller->render('users', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}