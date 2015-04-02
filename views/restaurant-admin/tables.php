<?php

/* @var $this \yii\web\View */
/* @var $tables \app\models\DinningTable[] */

use yii\helpers\Url;

$this->title = Yii::t('app','Manage Tables');
$counter = 1;
?>
<div style="margin-bottom: 10px">
    <a class="btn btn-sm btn-primary" href="<?= Url::toRoute(['restaurant-admin/add-table']) ?>">
        + <?= Yii::t('app','Add new table') ?>
    </a>
</div>
<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">#</th>
        <th class="text-center"><?= Yii::t('app', 'Table Name') ?></th>
        <th class="text-center"><?= Yii::t('app', 'Status') ?></th>
        <th class="text-center"><?= Yii::t('app', 'Action') ?></th>
    </tr>
    <?php foreach ($tables as $table) : ?>
        <tr>
            <td class="text-center">
                <?= $counter++ ?>
            </td>
            <td>
                <?= $table->table_name ?>
            </td>
            <td class="text-center">
                <?= $table->active == 1 ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive') ?>
            </td>
            <td class="text-center">
                <a href="<?= Url::toRoute([
                    'restaurant-admin/edit-table',
                    'tableId' => $table->table_id,
                ]) ?>"><?= Yii::t('app', 'Edit') ?></a>
                &nbsp; | &nbsp;
                <?php if ($table->active == '1') : ?>
                    <a href="<?= Url::toRoute([
                        'restaurant-admin/deactivate-table',
                        'tableId' => $table->table_id,
                    ]) ?>"><?= Yii::t('app', 'Deactivate') ?></a>
                <?php else : ?>
                    <a href="<?= Url::toRoute([
                        'restaurant-admin/activate-table',
                        'tableId' => $table->table_id,
                    ]) ?>"><?= Yii::t('app', 'Activate') ?></a>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>