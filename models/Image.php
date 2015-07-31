<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'required'],
            ['title', 'default', 'value' => ''],
            [['title', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('core/image', 'ID'),
            'title' => Yii::t('core/image', 'Title'),
            'image' => Yii::t('core/image', 'Image'),
        ];
    }
}
