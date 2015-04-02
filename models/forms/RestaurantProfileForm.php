<?php

namespace app\models\forms;

use Yii;
use app\models\Restaurant;

class RestaurantProfileForm extends Restaurant
{
    const SCENARIO_CREATE_BY_ADMIN = 'create_by_admin';
    const SCENARIO_UPDATE_BY_ADMIN = 'update_by_admin';
    const SCENARIO_UPDATE_BY_MANAGER = 'update_by_manager';

    public $gstRatePercent;
    public $pstRatePercent;
    public $hstRatePercent;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['gstRatePercent'] = Yii::t('app', 'GST Rate');
        $labels['pstRatePercent'] = Yii::t('app', 'PST Rate');
        $labels['hstRatePercent'] = Yii::t('app', 'HST Rate');

        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE_BY_ADMIN] = ['name_en_ca', 'name_zh_cn', 'name_zh_tw',
            'address', 'city', 'province', 'postal_code', 'phone', 'email', 'active',
            'gstRatePercent', 'pstRatePercent', 'hstRatePercent',
        ];
        $scenarios[self::SCENARIO_UPDATE_BY_ADMIN] = ['name_en_ca', 'name_zh_cn', 'name_zh_tw',
            'address', 'city', 'province', 'postal_code', 'phone', 'email', 'active',
            'gstRatePercent', 'pstRatePercent', 'hstRatePercent',
        ];
        $scenarios[self::SCENARIO_UPDATE_BY_MANAGER] = ['name_en_ca', 'name_zh_cn', 'name_zh_tw',
            'address', 'city', 'province', 'postal_code', 'phone', 'email',
            'gstRatePercent', 'pstRatePercent', 'hstRatePercent',
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_en_ca', 'active'], 'required'],
            [['name_en_ca', 'name_zh_cn', 'name_zh_tw', 'address', 'city', 'province', 'postal_code', 'phone', 'email',], 'trim'],
            [['name_en_ca', 'name_zh_cn', 'name_zh_tw', 'address'], 'string', 'length' => [1, 200]],
            [['city', 'province'], 'string', 'length' => [1, 50]],
            ['postal_code', 'string', 'length' => [1, 10]],
            ['phone', 'string', 'length' => [1, 20]],
            ['email', 'email'],
            ['email', 'string', 'length' => [5, 200]],
            [['gstRatePercent', 'pstRatePercent', 'hstRatePercent'], 'number', 'min' => 0, 'max' => 99],
            ['active', 'in', 'range' => [0, 1]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->gstRatePercent = 100 * $this->gst_rate;
        $this->pstRatePercent = 100 * $this->pst_rate;
        $this->hstRatePercent = 100 * $this->hst_rate;
    }

    /**
     * Create a new restaurant according to the form.
     *
     * @return bool Whether the restaurant was successfully created.
     */
    public function saveForm()
    {
        if (!$this->validate()) {

            return false;
        }

        $this->gst_rate = round($this->gstRatePercent / 100, 6);
        $this->pst_rate = round($this->pstRatePercent / 100, 6);
        $this->hst_rate = round($this->hstRatePercent / 100, 6);

        return $this->save(false);
    }
}
