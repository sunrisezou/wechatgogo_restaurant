<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "for_here_order_dish".
 *
 * @property string $for_here_order_id
 * @property string $dish_id
 * @property string $price
 *
 * @property ForHereOrder $forHereOrder
 * @property Dish $dish
 */
class ForHereOrderDish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'for_here_order_dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['for_here_order_id', 'dish_id', 'price'], 'required'],
            [['for_here_order_id', 'dish_id'], 'integer'],
            [['price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'for_here_order_id' => Yii::t('app', 'For Here Order ID'),
            'dish_id' => Yii::t('app', 'Dish ID'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForHereOrder()
    {
        return $this->hasOne(ForHereOrder::className(), ['for_here_order_id' => 'for_here_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['dish_id' => 'dish_id']);
    }
}
