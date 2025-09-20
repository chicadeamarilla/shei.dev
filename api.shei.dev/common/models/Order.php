<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "_order".
 *
 * @property int $id
 * @property string $user_id
 * @property int $status
 * @property string $address_id
 * @property int $total_price
 * @property string $pay_method
 */
class Order extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'address_id', 'total_price', 'pay_method'], 'required'],
            [['status', 'total_price'], 'integer'],
            [['user_id', 'address_id'], 'string', 'max' => 1000],
            [['pay_method'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'address_id' => 'Address ID',
            'total_price' => 'Total Price',
            'pay_method' => 'Pay Method',
        ];
    }

}
