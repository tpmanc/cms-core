<?php

use Yii\t;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'seoTitle') ?>

    <?= $form->field($model, 'seoDescription') ?>

    <?= $form->field($model, 'seoKeywords') ?>

    <?php // echo $form->field($model, 'seoText') ?>

    <?php // echo $form->field($model, 'chpu') ?>

    <?php // echo $form->field($model, 'productCount') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'isDisabled') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('core', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('core', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
