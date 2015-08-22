<?php

namespace tpmanc\cmscore\models;

use Yii;
use yii\helpers\Html;
use tpmanc\cmscore\models\Category;
use tpmanc\cmscore\models\ProductCategories;
use tpmanc\cmscore\models\ProductRests;
use tpmanc\filebehavior\ImageBehavior;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $shortDescription
 * @property integer $netCost
 * @property integer $price
 * @property integer $discount
 * @property string $nomenclature
 * @property double $length
 * @property double $width
 * @property double $height
 * @property double $weight
 * @property string $seoTitle
 * @property string $seoDescription
 * @property string $seoKeywords
 * @property string $chpu
 * @property integer $fakeInStock
 * @property integer $isDisabled
 */
class Product extends \yii\db\ActiveRecord
{
    const IS_ENABLED = 0;
    const IS_DISABLED = 1;

    public $mainCategory;

    public $additionalCategories = [];

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            'ImageBehavior' => [
                'class' => ImageBehavior::className(),
                'imageModel' => 'tpmanc\cmscore\models\ProductImage',
                'imageSizeModel' => 'tpmanc\cmscore\models\ImageSize',
                'imageVariable' => 'file',
                'imageFolder' => '@upload/product',
                'webImageFolder' => '@webupload/product',
                'noImagePath' => '@webupload/no-image.png',
                'imageSizes' => [
                    'original' => [
                        'width' => 800,
                        'height' => 600,
                        'folder' => 'original',
                    ],
                    'big' => [
                        'width' => 400,
                        'height' => 300,
                        'folder' => 'big',
                    ],
                    'small' => [
                        'width' => 64,
                        'height' => 64,
                        'folder' => 'small',
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price', 'chpu', 'fakeInStock', 'isDisabled', 'mainCategory'], 'required'],
            [['price', 'discount', 'fakeInStock', 'isDisabled', 'mainCategory'], 'integer'],
            ['mainCategory', 'compare', 'compareValue' => 0, 'operator' => '!=', 'message' => Yii::t('core/product', 'Select Main Category')],
            [['description', 'shortDescription'], 'string'],
            [['length', 'width', 'height', 'weight', 'netCost'], 'number'],
            ['additionalCategories', 'each', 'rule' => ['integer']],
            ['chpu', 'unique'],
            ['chpu', 'match',
                'pattern' => '/[A-Za-z0-9\-\_\(\)]+$/i',
                'message' => Yii::t('core/product', 'Chpu is invalid. Should contain only "0-9", "A-Z", "a-z", "-", "_"')
            ],
            [['title', 'nomenclature', 'seoTitle', 'seoKeywords', 'chpu'], 'string', 'max' => 255],
            [['seoDescription'], 'string', 'max' => 500],
            [
                ['isDisabled', 'netCost', 'discount', 'length', 'width', 'height', 'weight', 'fakeInStock'],
                'default',
                'value' => 0,
            ],
            [
                ['description', 'shortDescription', 'nomenclature', 'seoTitle', 'seoDescription', 'seoKeywords'],
                'default',
                'value' => '',
            ],
            ['file', 'file', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024*1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mainCategory' => Yii::t('core/product', 'Main Category'),
            'additionalCategories' => Yii::t('core/product', 'Additional Categories'),
            'title' => Yii::t('core/product', 'Title'),
            'description' => Yii::t('core/product', 'Description'),
            'shortDescription' => Yii::t('core/product', 'Short Description'),
            'netCost' => Yii::t('core/product', 'Net Cost'),
            'price' => Yii::t('core/product', 'Price'),
            'discount' => Yii::t('core/product', 'Discount'),
            'nomenclature' => Yii::t('core/product', 'Nomenclature'),
            'length' => Yii::t('core/product', 'Length'),
            'width' => Yii::t('core/product', 'Width'),
            'height' => Yii::t('core/product', 'Height'),
            'weight' => Yii::t('core/product', 'Weight'),
            'seoTitle' => 'Seo Title',
            'seoDescription' => 'Seo Description',
            'seoKeywords' => 'Seo Keywords',
            'chpu' => Yii::t('core/product', 'Chpu'),
            'fakeInStock' => Yii::t('core/product', 'Fake In Stock'),
            'isDisabled' => Yii::t('core/product', 'Is Disabled'),
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(ProductCategories::className(), ['productId' => 'id']);
    }

    public function getAdditionalCategoriesModels()
    {
        return $this->hasMany(ProductCategories::className(), ['productId' => 'id'])->where(['isMainCategory' => Category::IS_ADDITIONAL_CATEGORY]);
    }

    public function getMainCategoryModel()
    {
        return $this->hasOne(ProductCategories::className(), ['productId' => 'id'])->where(['isMainCategory' => Category::IS_MAIN_CATEGORY]);
    }

    public function getAdditionalCategoriesString()
    {
        $arr = [];
        $categories = $this->additionalCategoriesModels;
        foreach ($categories as $c) {
            $arr[] = Html::a($c->info->title, ['category/view', 'id' => $c->info->id], ['target' => '_blank']);
        }
        return implode(', ', $arr);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        ProductCategories::deleteAll(['productId' => $this->id]);
        // save main category
        $mainCat = $this->mainCategory;
        if ($mainCat != 0) {
            $mainCategory = new ProductCategories();
            $mainCategory->productId = $this->id;
            $mainCategory->categoryId = $mainCat;
            $mainCategory->isMainCategory = Category::IS_MAIN_CATEGORY;
            $mainCategory->save();
        }
        // save additional categories
        $addCats = $this->additionalCategories;
        if (is_array($addCats)) {
            foreach ($addCats as $categoryId) {
                if ($categoryId != $mainCat) {
                    $category = new ProductCategories();
                    $category->productId = $this->id;
                    $category->categoryId = $categoryId;
                    $category->isMainCategory = Category::IS_ADDITIONAL_CATEGORY;
                    $category->save();
                }
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Rests relation
     */
    public function getRests()
    {
        return $this->hasOne(ProductRests::className(), ['productId' => 'id']);
    }

    /**
     * Check products rests
     * @return boolean Return true if product is available
     */
    public function isAvailable()
    {
        if ($this->fakeInStock === 1) {
            return true;
        }
        if ($this->rests !== null && $this->rests->amount > 0) {
            return true;
        }
        return false;
    }
}
