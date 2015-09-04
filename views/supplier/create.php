<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Supplier */

$this->title = Yii::t('core/supplier', 'Create Supplier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/supplier', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
