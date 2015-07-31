<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductRests */

$this->title = $model->product->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/productRests', 'Product Rests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-rests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('core', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('core/productRests', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'productId',
                'value' => $model->product->title,
            ],
            'amount',
        ],
    ]) ?>

</div>
