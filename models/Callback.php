<?php

namespace tpmanc\cmscore\models;

use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $date
 * @property integer $status
 */
class Callback extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_CANCELED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['status', 'date'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => 0],
            ['date', 'default', 'value' => time()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('core/callback', 'Name'),
            'phone' => Yii::t('core/callback', 'Phone'),
            'date' => Yii::t('core/callback', 'Date'),
            'status' => Yii::t('core/callback', 'Status'),
        ];
    }
}
