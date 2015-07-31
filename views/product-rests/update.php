<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductRests */

$this->title = Yii::t('core/productRests', 'Update Rests') . ': '. $model->product->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/productRests', 'Product Rests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('core', 'Update');
?>
<div class="product-rests-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
