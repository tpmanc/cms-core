<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StaticPage */

$this->title = Yii::t('app/staticPage', 'Update Page') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/staticPage', 'Static Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="static-page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
