<?php

use Yii\t;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php 
    if (!$model->isNewRecord) { ?>
        <div id="categoryImages">
            <?php 
                $images = $model->getImages('medium');
                foreach ($images as $id => $path) {
                    if ($id !== 0) { ?>
                        <div class="category-image-holder">
                            <?= Html::img(Yii::$app->params['frontendUrl'] . $path, [
                                'class' => 'category-image',
                                'data' => [
                                    'id' => $id,
                                ],
                            ]) ?>
                            <i class="material-icons delete-icon">delete</i>
                        </div>
            <?php   }
                }
            ?>
        </div>
    <?php } ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'seoTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoKeywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seoText')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'ru',
            'minHeight' => 250,
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ]) ?>

    <?= $form->field($model, 'chpu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isDisabled')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
