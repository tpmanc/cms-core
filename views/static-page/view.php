<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StaticPage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/staticPage', 'Static Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core', 'Preview'), ['/page/'], ['class' => 'btn btn-success', 'target' => '_blank']); ?>
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
            'id',
            'title',
            'text:raw',
            'seoTitle',
            'seoDescription',
            'seoKeywords',
            'chpu',
        ],
    ]) ?>

</div>
