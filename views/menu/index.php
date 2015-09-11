<?php
use tpmanc\tree\widgets\NestedSets;
use tpmanc\cmscore\models\Menu;

/* @var $this yii\web\View */
/* @var $menuRoots common\models\Menu */
/* @var $menu common\models\Menu */
/* @var $categories common\models\Category */

$this->title = Yii::t('core/menu', 'Menu Builder');
$this->params['breadcrumbs'][] = $this->title;

//$level = 0;
//$fixed = false;
//echo '<ul>';
//foreach($menu as $n=>$category) {
//    if ($fixed) {
//        if ($category->depth == $level) {
//            echo '</li>';
//        } elseif ($category->depth > $level) {
//            echo '<ul>';
//        } else {
//            echo '</li>';
//            for ($i = $level - $category->depth; $i; $i--) {
//                echo '</ul>';
//                echo '</li>';
//            }
//        }
//    } else {
//        $fixed = true;
//    }
//
//    echo '<li>';
//    echo $category->name;
//    $level=$category->depth;
//}
//
//for($i = $level; $i; $i--) {
//    echo '</li>';
//    echo '</ul>';
//}
//echo '</li>';
//echo '</ul>';die();
// TODO: изменение параметров элемента и изменение сортировки в пределах одного depth
?>
<h1><?= Yii::t('core/menu', 'Menu Builder') ?></h1>

<?php /* <p>
    <button type="button" class="btn btn-success" id="addElement"><?= Yii::t('core/menu', 'Add Element') ?></button>
</p> */ ?>

<?= NestedSets::widget([
    'modelClass' => Menu::className(),
    'jsTreeOptions' => [
        'clientOptions' => [
            'plugins' => ["wholerow", "checkbox"],
        ]
    ],
]) ?>

<div style="display: none;">
    <div class="box-modal" id="elementModal">
        <i class="box-modal_close arcticmodal-close material-icons">clear</i>

        <div class="form-group">

            <div class="radio">
                <label>
                    <input type="radio" name="isCategory" value="1" checked>
                    Категория
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="isCategory" value="0">
                    Ссылка
                </label>
            </div>

            <div class="input-group" style="display: none;">
                <span class="input-group-addon"><?= Yii::t('core/menu', 'Link') ?></span>
                <input type="text" class="form-control" id="elementLink">
            </div>

            <select class="form-control" id="allCategories">
                <option value="0" disabled selected><?= Yii::t('core/menu', 'Select category') ?></option>
                <?php foreach ($categories as $c) { ?>
                    <option data-title="<?= $c->title ?>" value="<?= $c->id ?>"><?= $c->title ?></option>
                <?php } ?>
            </select>

            <br />

            <div class="input-group">
                <span class="input-group-addon"><?= Yii::t('core/menu', 'Item Title') ?></span>
                <input type="text" class="form-control" id="elementTitle">
            </div>

            <br />

            <input type="hidden" id="parentId" value="0" />
            <button type="button" class="btn btn-success" id="saveElement"><?= Yii::t('core', 'Save') ?></button>
        </div>
    </div>
</div>
