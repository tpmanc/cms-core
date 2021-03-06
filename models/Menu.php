<?php

namespace tpmanc\cmscore\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use tpmanc\tree\behaviors\NestedSetsManagementBehavior;
use tpmanc\cmscore\models\MenuQuery;
use tpmanc\cmscore\models\Category;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property string $link
 * @property integer $isCategory
 * @property integer $categoryId
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    public function rules()
    {
        return [
            ['name', 'default', 'value' => 'Новый узел'],
        ];
    }

    public function behaviors() {
        return [
            NestedSetsBehavior::className(),
            NestedSetsManagementBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Name',
            'link' => 'Link',
            'isCategory' => 'Is Category',
            'categoryId' => 'Category ID',
            'isDisabledInBreadcrumbs' => ' Is Disabled In Breadcrumbs',
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    public function getCategory()
    {
        if ($this->isCategory === 1) {
            return $this->hasOne(Category::className(), ['id' => 'categoryId']);
        } else {
            throw new Exception('This element has not category link');
        }
    }

    public function getInfo()
    {
        if ($this->isCategory === 1) {
            return $this->hasOne(Category::className(), ['id' => 'categoryId'])->asArray();
        } else {
            return [
                'title' => $this->name,
                'chpu' => $this->link,
            ];
        }
    }

    public function getLink()
    {
        if ($this->isCategory === 1) {
            return $this->category->chpu;
        } else {
            return $this->link;
        }
    }

    public static function getMenuRoot()
    {
        return Menu::findOne(['name' => 'Menu Root', 'depth' => 0]);
    }
}
