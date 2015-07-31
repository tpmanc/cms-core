<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "productImage".
 *
 * @property integer $id
 * @property integer $itemId
 * @property integer $fileId
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
            [['itemId', 'fileId'], 'required'],
            [['itemId', 'fileId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('core/productImage', 'ID'),
            'itemId' => Yii::t('core/productImage', 'Item ID'),
            'fileId' => Yii::t('core/productImage', 'File ID'),
        ];
    }
}
