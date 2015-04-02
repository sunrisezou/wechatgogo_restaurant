<?php

namespace app\components\actions\restaurant_admin;

use Yii;
use app\models\DinningTable;

class AddTable extends \yii\base\Action
{
    public function run()
    {
        $restaurantId = Yii::$app->user->identity->restaurant_id;

        $table = new DinningTable([
            'restaurant_id' => $restaurantId,
            'active' => 1,
        ]);

        $table->scenario = DinningTable::SCENARIO_CREATION;

        if ($table->load(Yii::$app->getRequest()->post()) && $table->validate()) {
            $table->save();

            $this->controller->redirect(['tables']);
        }

        return $this->controller->render('new-table',[
            'table' => $table,
        ]);
    }
}