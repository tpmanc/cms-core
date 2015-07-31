<?php

use Yii\t;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StaticPage */

$this->title = Yii::t('core/staticPage', 'Create Page');

$this->params['breadcrumbs'][] = ['label' => Yii::t('core/staticPage', 'Static Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
