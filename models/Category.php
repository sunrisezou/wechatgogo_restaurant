<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $category_id
 * @property string $restaurant_id
 * @property string $name_en_ca
 * @property string $name_zh_cn
 * @property string $name_zh_tw
 * @property integer $active
 *
 * @property Restaurant $restaurant
 * @property Dish[] $dishes
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'name_en_ca', 'name_zh_cn', 'name_zh_tw', 'active'], 'required'],
            [['restaurant_id', 'active'], 'integer'],
            [['name_en_ca', 'name_zh_cn', 'name_zh_tw'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'name_en_ca' => Yii::t('app', 'Name En Ca'),
            'name_zh_cn' => Yii::t('app', 'Name Zh Cn'),
            'name_zh_tw' => Yii::t('app', 'Name Zh Tw'),
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
    public function getDishes()
    {
        return $this->hasMany(Dish::className(), ['category_id' => 'category_id']);
    }
}
