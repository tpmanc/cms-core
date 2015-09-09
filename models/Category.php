<?php

namespace tpmanc\cmscore\models;

use Yii;
use tpmanc\cmscore\models\Product;
use tpmanc\filebehavior\ImageBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property string $seoTitle
 * @property string $seoDescription
 * @property string $seoKeywords
 * @property string $seoText
 * @property string $chpu
 * @property integer $parentId
 * @property integer $level
 * @property string $idPath
 * @property integer $productCount
 * @property integer $isDisabled
 * @property integer $isBrand
 * @property integer $isVisibleInBreadcrumbs
 * @property integer $isVisibleInMenu
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @var object Category image
     */
    public $image;

    const IS_MAIN_CATEGORY = 1;
    const IS_ADDITIONAL_CATEGORY = 0;

    const IS_DISABLED = 1;
    const IS_ENABLED = 0;

    const IS_BRAND = 1;
    const IS_NOT_BRAND = 0;

    const IS_VISIBLE_IN_MENU = 1;
    const IS_INVISIBLE_IN_MENU = 0;

    const IS_VISIBLE_IN_BREADCRUMBS = 1;
    const IS_INVISIBLE_IN_BREADCRUMBS = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function scenarios()
    {
        return [
            'create' => ['title', 'seoTitle', 'seoDescription', 'seoKeywords', 
                         'seoText', 'chpu', 'isDisabled', 'isBrand', 'isVisibleInBreadcrumbs', 'isVisibleInMenu', 'image'],
            'update' => ['title', 'seoTitle', 'seoDescription', 'seoKeywords',
                         'seoText', 'chpu', 'isDisabled', 'isBrand', 'isVisibleInBreadcrumbs', 'isVisibleInMenu', 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'ImageBehavior' => [
                'class' => ImageBehavior::className(),
                'imageModel' => 'tpmanc\cmscore\models\CategoryImage',
                'imageSizeModel' => 'tpmanc\cmscore\models\CategoryImageSize',
                'imageVariable' => 'image',
                'imageFolder' => '@upload',
                'webImageFolder' => '@webupload',
                'noImagePath' => '@webupload/no-image.png',
                'imageSizes' => [
                    'medium' => [
                        'width' => Yii::$app->params['categoryMedium']['width'],
                        'height' => Yii::$app->params['categoryMedium']['height'],
                        'folder' => 'category/medium',
                    ],
                    'small' => [
                        'width' => Yii::$app->params['categorySmall']['width'],
                        'height' => Yii::$app->params['categorySmall']['height'],
                        'folder' => 'category/small',
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
            [['title', 'chpu', 'productCount', 'isDisabled', 'isBrand'], 'required'],
            [['seoText'], 'string'],
            [['productCount'], 'integer'],
            [['isDisabled', 'isBrand', 'isVisibleInBreadcrumbs', 'isVisibleInMenu'], 'boolean'],
            [['title', 'seoTitle', 'seoKeywords', 'chpu'], 'string', 'max' => 255],
            [['seoDescription'], 'string', 'max' => 500],
            ['chpu', 'match', 
                'pattern' => '/^[A-Za-z0-9\-\_]+$/i', 
                'message' => Yii::t('core/category', 'Chpu is invalid. Should contain only "0-9", "A-Z", "a-z", "-", "_"')
            ],
            [['isDisabled', 'productCount', 'isBrand', 'isVisibleInMenu', 'isVisibleInBreadcrumbs'], 'default', 'value' => 0],
            [['seoTitle', 'seoDescription', 'seoKeywords', 'seoText'], 'default', 'value' => ''],
            ['image', 'file', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024*1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('core/category', 'Title'),
            'seoTitle' => 'Seo Title',
            'seoDescription' => 'Seo Description',
            'seoKeywords' => 'Seo Keywords',
            'seoText' => 'Seo Text',
            'chpu' => Yii::t('core/category', 'Chpu'),
            'productCount' => Yii::t('core/category', 'Product Count'),
            'isDisabled' => Yii::t('core/category', 'Is Disabled'),
            'isBrand' => Yii::t('core/category', 'Is Brand'),
            'isVisibleInBreadcrumbs' => Yii::t('core/category', 'Is Visible In Breadcrumbs'),
            'isVisibleInMenu' => Yii::t('core/category', 'Is Visible In Menu'),
            'image' => Yii::t('core/category', 'Image'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->productCount = 0;
        }
     
        return parent::beforeSave($insert);
    }

    public static function generateSelectBox($excludeCategory = false, $addEmpty = true)
    {
        $result = [];
        if ($addEmpty) {
            $result = [0 => ''];
        }
        $models = self::find()->all();
        if ($models !== null) {
            foreach ($models as $m) {
                if ($m->id !== $excludeCategory) {
                    $result[$m->id] = $m->title;
                }
            }
        }
        return $result;
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'productId'])->where(['isDisabled' => Product::IS_ENABLED])
            ->viaTable('productCategories', ['categoryId' => 'id']);
    }
}
