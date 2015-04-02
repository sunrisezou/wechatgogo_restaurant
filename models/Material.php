<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property string $material_id
 * @property string $restaurant_id
 * @property string $name_en_ca
 * @property string $name_zh_cn
 * @property string $name_zh_tw
 * @property string $unit
 * @property string $remaining
 * @property string $warning_value
 * @property string $notification_status
 * @property integer $active
 *
 * @property DishMaterial[] $dishMaterials
 * @property Dish[] $dishes
 * @property Restaurant $restaurant
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'name_en_ca', 'name_zh_cn', 'name_zh_tw', 'unit', 'remaining', 'warning_value', 'notification_status', 'active'], 'required'],
            [['restaurant_id', 'active'], 'integer'],
            [['remaining', 'warning_value'], 'number'],
            [['notification_status'], 'string'],
            [['name_en_ca', 'name_zh_cn', 'name_zh_tw'], 'string', 'max' => 200],
            [['unit'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'material_id' => Yii::t('app', 'Material ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'name_en_ca' => Yii::t('app', 'Name En Ca'),
            'name_zh_cn' => Yii::t('app', 'Name Zh Cn'),
            'name_zh_tw' => Yii::t('app', 'Name Zh Tw'),
            'unit' => Yii::t('app', 'Unit'),
            'remaining' => Yii::t('app', 'Remaining'),
            'warning_value' => Yii::t('app', 'Warning Value'),
            'notification_status' => Yii::t('app', 'Notification Status'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishMaterials()
    {
        return $this->hasMany(DishMaterial::className(), ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasMany(Dish::className(), ['dish_id' => 'dish_id'])->viaTable('dish_material', ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['restaurant_id' => 'restaurant_id']);
    }
}
