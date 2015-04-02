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
            [
                'label' => Yii::t('app','Sign In'),
                'url'   => ['/site/login'],
            ],
    ],
]);
NavBar::end();