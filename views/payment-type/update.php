<?php

use Yii\t;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */

$this->title = Yii::t('core/paymentType', 'Update Payment Type') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/paymentType', 'Payment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('core', 'Update');
?>
<div class="payment-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
