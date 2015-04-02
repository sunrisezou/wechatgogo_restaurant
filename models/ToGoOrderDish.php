<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "to_go_order_dish".
 *
 * @property string $to_go_order_id
 * @property string $dish_id
 * @property string $price
 *
 * @property Dish $dish
 * @property ToGoOrder $toGoOrder
 */
class ToGoOrderDish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'to_go_order_dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to_go_order_id', 'dish_id', 'price'], 'required'],
            [['to_go_order_id', 'dish_id'], 'integer'],
            [['price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'to_go_order_id' => Yii::t('app', 'To Go Order ID'),
            'dish_id' => Yii::t('app', 'Dish ID'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['dish_id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToGoOrder()
    {
        return $this->hasOne(ToGoOrder::className(), ['to_go_order_id' => 'to_go_order_id']);
    }
}
