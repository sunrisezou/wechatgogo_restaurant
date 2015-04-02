<?php
/* @var $this \yii\web\View */
/* @var $userProfileForm \app\models\forms\UserProfileFrom */
/* @var $restaurantOptions array */

use app\components\AppConstant;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Add New User');

?>

<div>
    <?php $form = ActiveForm::begin([
        'id'                   => 'form_profile',
        'enableAjaxValidation' => true
    ]); ?>
    <?= $form->field($userProfileForm,'restaurant_id')->dropDownList($restaurantOptions) ?>
    <?= $form->field($userProfileForm, 'username')->textInput() ?>
    <?= $form->field($userProfileForm, 'plainTextPassword')->passwordInput() ?>
    <?= $form->field($userProfileForm, 'plainTextPasswordConfirm')->passwordInput() ?>
    <?= $form->field($userProfileForm, 'name')->textInput() ?>
    <?= $form->field($userProfileForm, 'email')->textInput() ?>
    <?= $form->field($userProfileForm, 'phone')->textInput() ?>
    <?= $form->field($userProfileForm, 'user_group')->dropDownList([
        AppConstant::USER_GROUP_MANAGER => Yii::t('app', 'Manager'),
        AppConstant::USER_GROUP_WAITER  => Yii::t('app', 'Waiter'),
        AppConstant::USER_GROUP_COOK    => Yii::t('app', 'Cook'),
    ]) ?>
    <hr>
    <div class="text-center">
        <a href="<?= Url::toRoute(['/system-admin/users']) ?>" class="btn btn-default">
            <?= Yii::t('app', 'Cancel') ?>
        </a>
        &nbsp;&nbsp;
        <button type="submit" class="btn btn-primary">
            <?= Yii::t('app', 'Create') ?>
        </button>
    </div>
    <?php ActiveForm::end(); ?>
</div>

