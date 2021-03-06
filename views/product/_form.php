<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use tpmanc\cmscore\models\Category;

/* @var $this yii\web\View */
/* @var $model tpmanc\cmscore\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php 
    if (!$model->isNewRecord) { ?>
        <div id="productImages">
            <?php 
                $images = $model->getImages('small');
                foreach ($images as $id => $path) {
                    if ($id !== 0) { ?>
                        <div class="product-image-holder">
                            <?= Html::img(Yii::$app->params['frontendUrl'] . $path, [
                                'class' => 'product-image',
                                'data' => [
                                    'id' => $id,
                                    'product-id' => $model->id,
                                ],
                            ]) ?>
                            <i class="material-icons delete-icon">delete</i>
                        </div>
            <?php   }
                }
            ?>
        </div>
    <?php } ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'mainCategory')->dropDownList(Category::generateSelectBox()) ?>

    <?= $form->field($model, 'additionalCategories')->listBox(Category::generateSelectBox($model->mainCategory, false), [
        'multiple' => true,
        'size' => 12,
    ]) ?>

    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'ru',
            'minHeight' => 250,
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>

    <?= $form->field($model, 'shortDescription')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'ru',
            'minHeight' => 250,
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>

    <?= $form->field($model, 'netCost')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'discountPrice')->textInput() ?>

    <?= $form->field($model, 'nomenclature')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoKeywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chpu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fakeInStock')->checkbox() ?>

    <?= $form->field($model, 'isDisabled')->checkbox() ?>

    <h3>Видео</h3>
    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <h3>Габариты</h3>

    <?= $form->field($model, 'length')->textInput() ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
