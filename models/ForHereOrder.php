<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "for_here_order".
 *
 * @property string $for_here_order_id
 * @property string $restaurant_id
 * @property string $table_id
 * @property string $total_price_before_tax
 * @property string $hst
 * @property string $pst
 * @property string $gst
 * @property string $total_price_after_tax
 * @property string $status
 * @property string $notes
 * @property string $last_update_time
 *
 * @property Restaurant $restaurant
 * @property DinningTable $table
 * @property ForHereOrderDish[] $forHereOrderDishes
 */
class ForHereOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'for_here_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'table_id', 'total_price_before_tax', 'hst', 'pst', 'gst', 'total_price_after_tax', 'status', 'notes', 'last_update_time'], 'required'],
            [['restaurant_id', 'table_id'], 'integer'],
            [['total_price_before_tax', 'hst', 'pst', 'gst', 'total_price_after_tax'], 'number'],
            [['notes'], 'string'],
            [['last_update_time'], 'safe'],
            [['status'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'for_here_order_id' => Yii::t('app', 'For Here Order ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'table_id' => Yii::t('app', 'Table ID'),
            'total_price_before_tax' => Yii::t('app', 'Total Price Before Tax'),
            'hst' => Yii::t('app', 'Hst'),
            'pst' => Yii::t('app', 'Pst'),
            'gst' => Yii::t('app', 'Gst'),
            'total_price_after_tax' => Yii::t('app', 'Total Price After Tax'),
            'status' => Yii::t('app', 'Status'),
            'notes' => Yii::t('app', 'Notes'),
            'last_update_time' => Yii::t('app', 'Last Update Time'),
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
    public function getTable()
    {
        return $this->hasOne(DinningTable::className(), ['table_id' => 'table_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForHereOrderDishes()
    {
        return $this->hasMany(ForHereOrderDish::className(), ['for_here_order_id' => 'for_here_order_id']);
    }
}
