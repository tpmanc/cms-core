<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "productImage".
 *
 * @property integer $id
 * @property integer $itemId
 * @property string $image
 * @property string $path
 * @property string $size
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productImage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemId', 'image', 'path', 'size'], 'required'],
            [['itemId'], 'integer'],
            [['image', 'path', 'size'], 'string', 'max' => 255]
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
            'image' => 'Image',
            'path' => 'Path',
            'size' => 'Size',
        ];
    }
}
