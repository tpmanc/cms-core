<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/product', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('core', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('core', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        $images = $model->getImages('big');
        foreach ($images as $image) {
            echo Html::img(Yii::getAlias('@webupload' . $image['path'] . $image['name']));
        }
    ?>

    <br>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'mainCategory',
                'format' => 'raw',
                'value' => Html::a($model->mainCategoryModel->info->title, [
                        'category/view', 'id' => $model->mainCategoryModel->info->id
                    ], ['target' => '_blank']),
            ],
            [
                'attribute'=>'additionalCategories',
                'format' => 'raw',
                'value' => $model->additionalCategoriesString,
            ],
            'title',
            'description:raw',
            'shortDescription:raw',
            'netCost',
            'price',
            'discount',
            'nomenclature',
            'length',
            'width',
            'height',
            'weight',
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            'chpu',
            'fakeInStock:boolean',
            'isDisabled:boolean',
            [
                'label' => Yii::t('core/productRests', 'Product Rests'),
                'value' => ($model->rests === null) ? 0 : $model->rests->amount,
            ],
        ],
    ]) ?>

</div>
