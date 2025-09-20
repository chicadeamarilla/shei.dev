<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "_product_category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property int|null $order_show
 */
class Product_category extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'order_show'], 'default', 'value' => null],
            [['name'], 'required'],
            [['order_show'], 'integer'],
            [['name', 'image'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'order_show' => 'Order Show',
        ];
    }

}
