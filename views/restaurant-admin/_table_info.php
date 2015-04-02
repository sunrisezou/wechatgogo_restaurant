<?php
/* @var $this \yii\web\View */
/* @var $table \app\models\DinningTable */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<?php $form = ActiveForm::begin() ?>

<?= $form->field($table, 'table_name')->textInput() ?>

    <div class="form-group">
        <div class="text-center">
            <a href="<?= Url::toRoute(['restaurant-admin/tables']) ?>" class="btn btn-default">
                <?= Yii::t('app','Cancel') ?>
            </a>
            &nbsp;&nbsp;
            <button class="btn btn-primary"><?= Yii::t('app','Save') ?></button>
        </div>
    </div>

<?php ActiveForm::end(); ?>