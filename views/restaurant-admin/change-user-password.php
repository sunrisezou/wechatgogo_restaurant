<?php

use app\components\AppConstant;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $userPasswordForm \app\models\forms/UserPasswordForm */
/* @var $user \app\models\User */

$this->title = Yii::t('app', 'Change Password');

?>

<?php $form = ActiveForm::begin() ?>
    <div class="well">
        <div class="row">
            <div class="col-xs-4">
                <strong>
                    <?= $user->getAttributeLabel('username') ?> :
                </strong>
            <span>
                <?= Yii::$app->formatter->asText($user->username) ?>
            </span>
            </div>
            <div class="col-xs-4">
                <strong>
                    <?= $user->getAttributeLabel('user_group') ?> :
                </strong>
            <span>
                <?php switch ($user->user_group) {
                    case AppConstant::USER_GROUP_MANAGER:
                        echo Yii::t('app','Manager');
                        break;
                    case AppConstant::USER_GROUP_WAITER:
                        echo Yii::t('app','Waiter');
                        break;
                    case AppConstant::USER_GROUP_COOK:
                        echo Yii::t('app','Cook');
                        break;
                    default:
                        echo Yii::$app->formatter->asText($user->user_group);
                } ?>
            </span>
            </div>
            <div class="col-xs-4">
                <strong>
                    <?= $user->getAttributeLabel('name') ?> :
                </strong>
            <span>
                <?= Yii::$app->formatter->asText($user->name) ?>
            </span>
            </div>
        </div>
    </div>
    <hr>
<?= $form->field($userPasswordForm, 'plainTextPassword')->passwordInput() ?>
<?= $form->field($userPasswordForm, 'plainTextPasswordConfirm')->passwordInput() ?>
    <div class="text-center">
        <a href="<?= Url::toRoute(['/restaurant-admin/users']) ?>" class="btn btn-default">
            <?= Yii::t('app', 'Cancel') ?>
        </a>
        &nbsp;&nbsp;
        <button type="submit" class="btn btn-primary">
            <?= Yii::t('app', 'Update') ?>
        </button>
    </div>
<?php ActiveForm::end(); ?>