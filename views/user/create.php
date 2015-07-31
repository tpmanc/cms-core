<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('core/user', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core/user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
        'userRole' => $userRole,
        'errors' => $errors,
    ]) ?>

</div>
