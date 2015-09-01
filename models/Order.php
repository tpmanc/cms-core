<?php

namespace tpmanc\cmscore\models;

use Yii;
use tpmanc\cmscore\models\OrderProducts;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $orderProductsId
 * @property string $name
 * @property string $adress
 * @property string $phone
 * @property string $email
 * @property string $extraInformation
 * @property integer $deliveryType
 * @property integer $paymentType
 * @property integer $date
 * @property integer $discount
 * @property integer $totalPrice
 * @property integer $deliveryPrice
 * @property integer $status
 * @property integer $isFastBuy
 *
 * @property OrderProducts[] $orderProducts
 */
// TODO: быстрый заказ и обратный звонок
// TODO: стоимость доставки
// TODO: сумма заказа
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_CANCELED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'deliveryType', 'paymentType', 'isFastBuy'], 'required'],
            [['status', 'deliveryType', 'paymentType', 'date', 'discount', 'totalPrice', 'deliveryPrice'], 'integer'],
            [['name', 'adress', 'phone', 'email', 'extraInformation'], 'string', 'max' => 255],
            ['email', 'email'],
            ['isFastBuy', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => false],

            [['discount', 'status', 'totalPrice', 'deliveryPrice'], 'default', 'value' => 0],
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
            'name' => Yii::t('core/order', 'Name'),
            'adress' => Yii::t('core/order', 'Adress'),
            'phone' => Yii::t('core/order', 'Phone'),
            'email' => Yii::t('core/order', 'Email'),
            'extraInformation' => Yii::t('core/order', 'Extra Information'),
            'deliveryType' => Yii::t('core/order', 'Delivery Type'),
            'paymentType' => Yii::t('core/order', 'Payment Type'),
            'date' => Yii::t('core/order', 'Date'),
            'discount' => Yii::t('core/order', 'Discount'),
            'totalPrice' => Yii::t('core/order', 'Total Price'),
            'deliveryPrice' => Yii::t('core/order', 'Delivery Price'),
            'status' => Yii::t('core/order', 'Status'),
            'isFastBuy' => Yii::t('core/order', 'Is Fast Buy'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProducts::className(), ['orderId' => 'id']);
    }
}
