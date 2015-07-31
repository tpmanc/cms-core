<?php

namespace tpmanc\cmscore\models;

use Yii;
use tpmanc\cmscore\models\Category;

/**
 * This is the model class for table "productCategories".
 *
 * @property integer $id
 * @property integer $productId
 * @property integer $categoryId
 * @property integer $isMainCategory
 */
class ProductCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productCategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'categoryId', 'isMainCategory'], 'required'],
            [['productId', 'categoryId', 'isMainCategory'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productId' => 'Product ID',
            'categoryId' => 'Category ID',
            'isMainCategory' => 'Is Main Category',
        ];
    }

    public function getInfo()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }
}
