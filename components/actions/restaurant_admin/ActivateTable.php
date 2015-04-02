<?php

namespace app\components\actions\restaurant_admin;

use Yii;
use app\models\DinningTable;

class ActivateTable extends \yii\base\Action
{
    public function run($tableId)
    {
        $restaurantId = Yii::$app->user->identity->restaurant_id;

        // Make sure the target dinning table and current user belong to the same restaurant.
        $table = DinningTable::findOne([
            'table_id' => $tableId,
            'restaurant_id' => $restaurantId,
        ]);

        if (empty($table)) {
            throw new BadRequestHttpException;
        }

        /* @var $table \app\models\DinningTable */
        $table->active = 1;
        $table->save();

        return $this->controller->redirect(['tables']);
    }
}