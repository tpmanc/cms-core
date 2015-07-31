<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeliveryTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core/deliveryType', 'Delivery Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core/deliveryType', 'Create Delivery Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'id',
                'options' => [
                    'width' => 70,
                ],
            ],
            'title',
            'text:ntext',
            [
                'attribute' => 'isDisabled',
                'format' => 'boolean',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'isDisabled',
                    ['' => '-', 0 => Yii::t('core', 'No'), 1 => Yii::t('core', 'Yes')],
                    ['class' => 'form-control']
                ),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'width' => 70,
                ],
            ],
        ],
    ]); ?>

</div>
