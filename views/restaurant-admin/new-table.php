<?php
/* @var $this \yii\web\View */
/* @var $table \app\models\DinningTable */

$this->title = Yii::t('app','Add New Table');

?>

<?= $this->render('_table_info', [
    'table' => $table,
]);

