<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "imageSize".
 *
 * @property integer $id
 * @property integer $imageId
 * @property string $path
 * @property string $size
 *
 * @property ProductImage $image
 */
class ImageSize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imageSize';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageId', 'path', 'size'], 'required'],
            [['imageId'], 'integer'],
            [['path', 'size'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'imageId' => 'Image ID',
            'path' => 'Path',
            'size' => 'Size',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ProductImage::className(), ['id' => 'imageId']);
    }
}
