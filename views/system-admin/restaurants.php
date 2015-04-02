<?php
/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\searches\GeneralUserSearch */

use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Manage Restaurants');

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
            'attribute'      => 'restaurant_id',
            'headerOptions'  => [
                'class' => 'text-center',
            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
        ],
        [
            'attribute'      => 'name_en_ca',
            'headerOptions'  => [
                'class' => 'text-center',
            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
        ],
        [
            'attribute'      => 'name_zh_cn',
            'headerOptions'  => [
                'class' => 'text-center',
            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
        ],
        [
            'attribute'      => 'name_zh_tw',
            'headerOptions'  => [
                'class' => 'text-center',
            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
        ],
        [
            'attribute'      => 'active',
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
                'style' => 'min-width:100px',

            ],
            'contentOptions' => [
                'class' => 'text-center',
            ],
            'value'          => function ($model, $key, $index, $column) {
                return Html::a(Yii::t('app', 'Edit'), [
                    '/system-admin/edit-restaurant',
                    'restaurantId' => $model->restaurant_id,
                ], ['data' => ['pjax' => '0']]);
            },
            'format'         => 'raw',
        ]
    ]
];

?>
<div>
    <a href="<?= Url::toRoute(['/system-admin/add-restaurant']) ?>?" class="btn btn-primary">
        + <?= Yii::t('app', 'Add New Restaurant') ?>
    </a>
    <a href="<?= Url::toRoute(['/system-admin/restaurants']) ?>?" class="btn btn-default pull-right">
        <?= Yii::t('app', 'Clear Filters') ?>
    </a>
</div>
<div class="clearfix" style="margin-bottom: 10px">

</div>
<div>
    <?= GridView::widget($gridviewCfg); ?>
</div>