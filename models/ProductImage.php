<?php

namespace tpmanc\cmscore\models;

use Yii;
use tpmanc\cmscore\models\ImageSize;

/**
 * This is the model class for table "productImage".
 *
 * @property integer $id
 * @property integer $itemId
 * @property string $name
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
        return $this->hasMany(ImageSize::className(), ['imageId' => 'id']);
    }
}
