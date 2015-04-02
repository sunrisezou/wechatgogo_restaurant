<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $customer_id
 * @property string $restaurant_id
 * @property string $phone
 * @property string $wechat_open_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 *
 * @property Restaurant $restaurant
 * @property ToGoOrder[] $toGoOrders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'phone', 'wechat_open_id', 'first_name', 'last_name', 'address', 'city', 'province', 'postal_code'], 'required'],
            [['restaurant_id'], 'integer'],
            [['phone'], 'string', 'max' => 20],
            [['wechat_open_id'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'address'], 'string', 'max' => 200],
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'phone' => Yii::t('app', 'Phone'),
            'wechat_open_id' => Yii::t('app', 'Wechat Open ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'province' => Yii::t('app', 'Province'),
            'postal_code' => Yii::t('app', 'Postal Code'),
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
    public function getToGoOrders()
    {
        return $this->hasMany(ToGoOrder::className(), ['customer_id' => 'customer_id']);
    }
}
