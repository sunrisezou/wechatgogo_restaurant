<?php
/* @var $this \yii\web\View */
/* @var $restaurantProfileForm \app\models\forms\RestaurantProfileForm */

use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Add New Restaurant');
?>

<div>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($restaurantProfileForm, 'name_en_ca')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'name_zh_cn')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'name_zh_tw')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'address')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'city')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'province')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'postal_code')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'phone')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'email')->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'gstRatePercent',[
        'addon' => ['append' => ['content'=>'%']]
    ])->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'pstRatePercent',[
        'addon' => ['append' => ['content'=>'%']]
    ])->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'hstRatePercent',[
        'addon' => ['append' => ['content'=>'%']]
    ])->textInput() ?>
    <?= $form->field($restaurantProfileForm, 'active')->dropDownList([
        '1' => Yii::t('app', 'Active'),
        '0' => Yii::t('app', 'Inactive'),
    ]) ?>

    <div class="text-center">
        <a href="<?= Url::toRoute(['/system-admin/restaurants']) ?>" class="btn btn-default">
            <?= Yii::t('app', 'Cancel') ?>
        </a>
        &nbsp;&nbsp;
        <button type="submit" class="btn btn-primary">
            <?= Yii::t('app', 'Create') ?>
        </button>
    </div>
    <?php ActiveForm::end(); ?>
</div>

