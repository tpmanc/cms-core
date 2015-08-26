<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "paymentType".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $isDisabled
 */
class PaymentType extends \yii\db\ActiveRecord
{
    const IS_DISABLED = 1;
    const IS_ENABLED = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paymentType';
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
            'id' => Yii::t('core/paymentType', 'ID'),
            'title' => Yii::t('core/paymentType', 'Title'),
            'text' => Yii::t('core/paymentType', 'Text'),
            'isDisabled' => Yii::t('core/paymentType', 'Is Disabled'),
        ];
    }
}
