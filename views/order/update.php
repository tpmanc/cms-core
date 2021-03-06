<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = Yii::t('core/order', 'Update {modelClass}: ', [
    'modelClass' => 'Order',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/order', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('core/order', 'Update');
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'orderProducts' => $orderProducts,
        'productDropDown' => $productDropDown,
    ]) ?>

</div>
