<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'id',
            [
                'attribute' => 'username',
                'label' => Yii::t('core/user', 'Username'),
            ],
            [
                'label' => Yii::t('core/user', 'Role'),
                'format' => 'raw',
                'value' => implode(', ', $model->getRolesArray()),
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'label' => Yii::t('core/user', 'Email'),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'label' => Yii::t('core/user', 'Created At'),
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'date',
                'label' => Yii::t('core/user', 'Updated At'),
            ],
            'auth_key',
            'password_hash',
            // 'password_reset_token',
            // 'status',
        ],
    ]) ?>

</div>
