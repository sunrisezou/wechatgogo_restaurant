<?php
use app\components\AppConstant;
use yii\helpers\Html;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">

    <?php if (Yii::$app->user->isGuest) : ?>
        <?= $this->render('@app/views/navigation/guest_navigation') ?>
    <?php else : ?>
        <?php switch (Yii::$app->user->identity->user_group) {
            case AppConstant::USER_GROUP_MANAGER :
                echo $this->render('@app/views/navigation/manager_navigation');
                break;
            case AppConstant::USER_GROUP_WAITER:
                echo $this->render('@app/views/navigation/waiter_navigation');
                break;
            case AppConstant::USER_GROUP_COOK:
                echo $this->render('@app/views/navigation/waiter_navigation');
                break;
            case AppConstant::USER_GROUP_ADMIN:
                echo $this->render('@app/views/navigation/admin_navigation');
                break;
        }?>
    <?php endif ?>

    <div class="container">
        <h1><?= $this->title ?></h1>
        <hr>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
