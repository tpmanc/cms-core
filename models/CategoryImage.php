<?php

namespace tpmanc\cmscore\models;

use Yii;
use tpmanc\cmscore\models\CategoryImageSize;

/**
 * This is the model class for table "productImage".
 *
 * @property integer $id
 * @property integer $itemId
 * @property string $name
 */
class CategoryImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoryImage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemId', 'name'], 'required'],
            [['itemId'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'name' => 'Name',
        ];
    }

    public function getImageSize()
    {
        return $this->hasMany(CategorysImageSize::className(), ['imageId' => 'id']);
    }
}
