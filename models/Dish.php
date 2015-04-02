<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dish".
 *
 * @property string $dish_id
 * @property string $restaurant_id
 * @property string $category_id
 * @property string $custom_dish_id
 * @property string $name_en_ca
 * @property string $name_zh_cn
 * @property string $name_zh_tw
 * @property string $description_en_ca
 * @property string $description_zh_cn
 * @property string $desription_zh_tw
 * @property string $price
 * @property string $creation_date
 * @property string $photo
 * @property integer $active
 *
 * @property Restaurant $restaurant
 * @property Category $category
 * @property DishMaterial[] $dishMaterials
 * @property Material[] $materials
 * @property ForHereOrderDish[] $forHereOrderDishes
 * @property ToGoOrderDish[] $toGoOrderDishes
 * @property ToGoOrder[] $toGoOrders
 */
class Dish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'category_id', 'custom_dish_id', 'name_en_ca', 'name_zh_cn', 'name_zh_tw', 'description_en_ca', 'description_zh_cn', 'desription_zh_tw', 'price', 'creation_date', 'photo', 'active'], 'required'],
            [['restaurant_id', 'category_id', 'custom_dish_id', 'active'], 'integer'],
            [['description_en_ca', 'description_zh_cn', 'desription_zh_tw'], 'string'],
            [['price'], 'number'],
            [['creation_date'], 'safe'],
            [['name_en_ca', 'name_zh_cn', 'name_zh_tw'], 'string', 'max' => 200],
            [['photo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dish_id' => Yii::t('app', 'Dish ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'custom_dish_id' => Yii::t('app', 'Custom Dish ID'),
            'name_en_ca' => Yii::t('app', 'Name En Ca'),
            'name_zh_cn' => Yii::t('app', 'Name Zh Cn'),
            'name_zh_tw' => Yii::t('app', 'Name Zh Tw'),
            'description_en_ca' => Yii::t('app', 'Description En Ca'),
            'description_zh_cn' => Yii::t('app', 'Description Zh Cn'),
            'desription_zh_tw' => Yii::t('app', 'Desription Zh Tw'),
            'price' => Yii::t('app', 'Price'),
            'creation_date' => Yii::t('app', 'Creation Date'),
            'photo' => Yii::t('app', 'Photo'),
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishMaterials()
    {
        return $this->hasMany(DishMaterial::className(), ['dish_id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['material_id' => 'material_id'])->viaTable('dish_material', ['dish_id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForHereOrderDishes()
    {
        return $this->hasMany(ForHereOrderDish::className(), ['dish_id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToGoOrderDishes()
    {
        return $this->hasMany(ToGoOrderDish::className(), ['dish_id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToGoOrders()
    {
        return $this->hasMany(ToGoOrder::className(), ['to_go_order_id' => 'to_go_order_id'])->viaTable('to_go_order_dish', ['dish_id' => 'dish_id']);
    }
}
