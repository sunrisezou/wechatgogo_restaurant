<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "to_go_order".
 *
 * @property string $to_go_order_id
 * @property string $restaurant_id
 * @property string $customer_id
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $order_time
 * @property string $status
 * @property string $total_price_before_tax
 * @property string $hst
 * @property string $pst
 * @property string $gst
 * @property string $total_parice_after_tax
 * @property string $notes
 * @property string $last_update_time
 *
 * @property Customer $customer
 * @property Restaurant $restaurant
 * @property ToGoOrderDish[] $toGoOrderDishes
 * @property Dish[] $dishes
 */
class ToGoOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'to_go_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'customer_id', 'address', 'city', 'province', 'postal_code', 'order_time', 'status', 'total_price_before_tax', 'hst', 'pst', 'gst', 'total_parice_after_tax', 'notes', 'last_update_time'], 'required'],
            [['restaurant_id', 'customer_id'], 'integer'],
            [['order_time', 'last_update_time'], 'safe'],
            [['total_price_before_tax', 'hst', 'pst', 'gst', 'total_parice_after_tax'], 'number'],
            [['notes'], 'string'],
            [['address', 'status'], 'string', 'max' => 200],
            [['city', 'province'], 'string', 'max' => 50],
            [['postal_code'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'to_go_order_id' => Yii::t('app', 'To Go Order ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'province' => Yii::t('app', 'Province'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'order_time' => Yii::t('app', 'Order Time'),
            'status' => Yii::t('app', 'Status'),
            'total_price_before_tax' => Yii::t('app', 'Total Price Before Tax'),
            'hst' => Yii::t('app', 'Hst'),
            'pst' => Yii::t('app', 'Pst'),
            'gst' => Yii::t('app', 'Gst'),
            'total_parice_after_tax' => Yii::t('app', 'Total Parice After Tax'),
            'notes' => Yii::t('app', 'Notes'),
            'last_update_time' => Yii::t('app', 'Last Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
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
    public function getToGoOrderDishes()
    {
        return $this->hasMany(ToGoOrderDish::className(), ['to_go_order_id' => 'to_go_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasMany(Dish::className(), ['dish_id' => 'dish_id'])->viaTable('to_go_order_dish', ['to_go_order_id' => 'to_go_order_id']);
    }
}
