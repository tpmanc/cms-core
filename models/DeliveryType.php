<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "deliveryType".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $isDisabled
 */
class DeliveryType extends \yii\db\ActiveRecord
{
    const IS_DISABLED = 1;
    const IS_ENABLED = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deliveryType';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['isDisabled'], 'boolean'],
            ['isDisabled', 'default', 'value' => 0],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('core/deliveryType', 'Title'),
            'text' => Yii::t('core/deliveryType', 'Text'),
            'isDisabled' => Yii::t('core/deliveryType', 'Is Disabled'),
        ];
    }
}
