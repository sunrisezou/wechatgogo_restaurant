<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl'   => Yii::$app->homeUrl,
    'options'    => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items'   => [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('app', 'Tables'), 'url' => ['/restaurant-admin/tables']],
        ['label' => Yii::t('app', 'Users'), 'url' => ['/restaurant-admin/users']],
        [
            'label' => Yii::t('app', 'Sign Out'),
            'url'   => ['/site/logout'],
        ],
    ],
]);
NavBar::end();