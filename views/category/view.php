<?php

use Yii\t;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => Html::img(Yii::$app->params['frontendUrl'] . $model->getImage('medium')),
            ],
            'title',
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            // 'seoText:ntext',
            'chpu',
            'productCount',
            'isDisabled:boolean',
            'isBrand:boolean',
        ],
    ]) ?>

    <hr>

    <h3><?= Yii::t('core/category', 'Seo Text')?></h3>
    <?= $model->seoText?>

</div>
