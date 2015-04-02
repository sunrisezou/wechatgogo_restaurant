<?php
/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\searches\UserSearch */

use app\components\AppConstant;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Manage Users');

$gridviewCfg = [
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout'       => "{items}\n{summary}\n{pager}",
    'pjax'         => true,
    'pjaxSettings' => [
        'options' => [
            'enablePushState' => false,
        ]
    ],
    'columns'      => [
        [
            'class' => '\kartik\grid\SerialColumn'
        ],
        [
            'attribute'     => 'username',
            'headerOptions' => [
                'class' => 'text-center',
            ],
        ],
        [
            'attribute'     => 'name',
            'headerOptions' => [
                'class' => 'text-center',
            ],
        ],
        [
            'attribute'      => 'user_group',
            'headerOptions'  => [
                'class' => 'text-center',
            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
            'value'          => function ($model, $key, $index, $column) {
                switch ($model->user_group) {
                    case AppConstant::USER_GROUP_MANAGER :
                        return Yii::t('app', 'Manager');
                    case AppConstant::USER_GROUP_WAITER;
                        return Yii::t('app', 'Waiter');
                    case AppConstant::USER_GROUP_COOK :
                        return Yii::t('app', 'Cook');
                    default :
                        return $model->user_group;
                }
            },
            'filter'         => [
                AppConstant::USER_GROUP_MANAGER => Yii::t('app', 'Manager'),
                AppConstant::USER_GROUP_WAITER  => Yii::t('app', 'Waiter'),
                AppConstant::USER_GROUP_COOK    => Yii::t('app', 'Cook'),
            ]

        ],
        [
            'attribute'      => 'active',
            'label'          => Yii::t('app', 'Status'),
            'headerOptions'  => [
                'class' => 'text-center',
            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
            'value'          => function ($model, $key, $index, $column) {
                return $model->active == 1 ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive');
            },
            'filter'         => [
                '1' => Yii::t('app', 'Active'),
                '2' => Yii::t('app', 'Inactive'),
            ]

        ],
        [
            'label'          => Yii::t('app', 'Actions'),
            'headerOptions'  => [
                'class' => 'text-center',
                'style' => 'min-width:300px',

            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
            'value'          => function ($model, $key, $index, $column) {
                return Html::a(Yii::t('app', 'Edit'), [
                    '/restaurant-admin/edit-user',
                    'userId' => $model->user_id,
                ],['data' => ['pjax' => '0']]) . '&nbsp;|&nbsp;' . Html::a(Yii::t('app', 'Change Password'), [
                    '/restaurant-admin/change-user-password',
                    'userId' => $model->user_id,
                ],['data' => ['pjax' => '0']]);
            },
            'format'         => 'raw',
        ]
    ]
];
?>
<div>
    <a href="<?= Url::toRoute(['/restaurant-admin/add-user']) ?>?" class="btn btn-primary">
        + <?= Yii::t('app', 'Add New User') ?>
    </a>
    <a href="<?= Url::toRoute(['/restaurant-admin/users']) ?>?" class="btn btn-default pull-right">
        <?= Yii::t('app', 'Clear Filters') ?>
    </a>
</div>
<div class="clearfix" style="margin-bottom: 10px">

</div>
<div>
    <?= GridView::widget($gridviewCfg); ?>
</div>
