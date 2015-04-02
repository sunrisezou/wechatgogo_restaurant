<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dinning_table".
 *
 * @property string $table_id
 * @property string $restaurant_id
 * @property string $table_name
 * @property integer $active
 *
 * @property Restaurant $restaurant
 * @property ForHereOrder[] $forHereOrders
 */
class DinningTable extends \yii\db\ActiveRecord
{
    CONST SCENARIO_CREATION = 'creation';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dinning_table';
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATION] = ['table_name'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'table_name', 'active'], 'required'],
            [['restaurant_id', 'active'], 'integer'],
            [['table_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'table_id' => Yii::t('app', 'Table ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'table_name' => Yii::t('app', 'Table Name'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForHereOrders()
    {
        return $this->hasMany(ForHereOrder::className(), ['table_id' => 'table_id']);
    }
}
