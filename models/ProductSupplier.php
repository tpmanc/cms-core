<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "productSupplier".
 *
 * @property integer $id
 * @property integer $productId
 * @property integer $supplierId
 * @property string $nomenclature
 *
 * @property Supplier $supplier
 * @property Product $product
 */
class ProductSupplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productSupplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'supplierId', 'nomenclature'], 'required'],
            [['productId', 'supplierId'], 'integer'],
            [['nomenclature'], 'string', 'max' => 255]
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
            'supplierId' => 'Supplier ID',
            'nomenclature' => 'Nomenclature',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplierId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }
}
