<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "restaurant".
 *
 * @property string $restaurant_id
 * @property string $name_en_ca
 * @property string $name_zh_cn
 * @property string $name_zh_tw
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $phone
 * @property string $email
 * @property string $gst_rate
 * @property string $pst_rate
 * @property string $hst_rate
 * @property integer $active
 *
 * @property Category[] $categories
 * @property Customer[] $customers
 * @property DinningTable[] $dinningTables
 * @property Dish[] $dishes
 * @property ForHereOrder[] $forHereOrders
 * @property Material[] $materials
 * @property ToGoOrder[] $toGoOrders
 * @property User[] $users
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_en_ca', 'name_zh_cn', 'name_zh_tw', 'address', 'city', 'province', 'postal_code', 'phone', 'email', 'gst_rate', 'pst_rate', 'hst_rate', 'active'], 'required'],
            [['gst_rate', 'pst_rate', 'hst_rate'], 'number'],
            [['active'], 'integer'],
            [['name_en_ca', 'name_zh_cn', 'name_zh_tw', 'address', 'email'], 'string', 'max' => 200],
            [['city', 'province'], 'string', 'max' => 50],
            [['postal_code'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'name_en_ca' => Yii::t('app', 'Name - English'),
            'name_zh_cn' => Yii::t('app', 'Name - Simplified Chinese'),
            'name_zh_tw' => Yii::t('app', 'Name - Traditional Chinese'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'province' => Yii::t('app', 'Province'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'gst_rate' => Yii::t('app', 'Gst Rate'),
            'pst_rate' => Yii::t('app', 'Pst Rate'),
            'hst_rate' => Yii::t('app', 'Hst Rate'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDinningTables()
    {
        return $this->hasMany(DinningTable::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasMany(Dish::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForHereOrders()
    {
        return $this->hasMany(ForHereOrder::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToGoOrders()
    {
        return $this->hasMany(ToGoOrder::className(), ['restaurant_id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['restaurant_id' => 'restaurant_id']);
    }
}
