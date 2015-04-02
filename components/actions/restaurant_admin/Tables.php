<?php

namespace app\components\actions\restaurant_admin;

use Yii;
use app\models\DinningTable;

class Tables extends \yii\base\Action
{
    public function run()
    {
        $restaurantId = Yii::$app->user->identity->restaurant_id;

        $tables = DinningTable::find()
            ->where(['restaurant_id' => $restaurantId])
            ->orderBy('active DESC,table_name ASC')
            ->all();

        return $this->controller->render('tables', [
            'tables' => $tables,
        ]);
    }
}