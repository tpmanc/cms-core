<?php

use Yii\t;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core/category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core/category', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('core/category', 'Download CSV'), ['get-csv'], ['class' => 'btn btn-warning']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => [
                    'width' => 10,
                ],
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img(Yii::$app->params['frontendUrl'] . $data->getImage('small'), ['width'=>'50']);
                },
            ],
            'title',
            // 'text:raw',
            'seoTitle',
            // 'seoDescription',
            'chpu',
            [
                'attribute' => 'isDisabled',
                'format' => 'boolean',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'isDisabled',
                    ['' => '-', 0 => Yii::t('core', 'No'), 1 => Yii::t('core', 'Yes')],
                    ['class' => 'form-control']
                ),
            ],
            [
                'attribute' => 'isBrand',
                'format' => 'boolean',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'isBrand',
                    ['' => '-', 0 => Yii::t('core', 'No'), 1 => Yii::t('core', 'Yes')],
                    ['class' => 'form-control']
                ),
            ],
            [
                'attribute' => 'isVisibleInMenu',
                'format' => 'boolean',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'isVisibleInMenu',
                    ['' => '-', 0 => Yii::t('core', 'No'), 1 => Yii::t('core', 'Yes')],
                    ['class' => 'form-control']
                ),
            ],
            [
                'attribute' => 'isVisibleInBreadcrumbs',
                'format' => 'boolean',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'isVisibleInBreadcrumbs',
                    ['' => '-', 0 => Yii::t('core', 'No'), 1 => Yii::t('core', 'Yes')],
                    ['class' => 'form-control']
                ),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'width' => 70,
                ],
            ],
        ],
    ]); ?>

</div>
