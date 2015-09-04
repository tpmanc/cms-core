<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property integer $title
 *
 * @property ProductSupplier $productSuppliers
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['title'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('core/supplier', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplier()
    {
        return $this->hasOne(ProductSupplier::className(), ['supplierId' => 'id']);
    }
}
