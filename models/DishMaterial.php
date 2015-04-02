<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dish_material".
 *
 * @property string $dish_id
 * @property string $material_id
 * @property string $cost
 *
 * @property Dish $dish
 * @property Material $material
 */
class DishMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dish_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'material_id', 'cost'], 'required'],
            [['dish_id', 'material_id'], 'integer'],
            [['cost'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dish_id' => Yii::t('app', 'Dish ID'),
            'material_id' => Yii::t('app', 'Material ID'),
            'cost' => Yii::t('app', 'Cost'),
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
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['material_id' => 'material_id']);
    }
}
