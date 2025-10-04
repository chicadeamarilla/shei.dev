<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "_product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int $stock
 * @property string $description
 * @property string|null $image
 * @property int|null $order_show
 */
class Product extends \yii\db\ActiveRecord
{

    public $category_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'order_show'], 'default', 'value' => null],
            [['name', 'price', 'stock', 'description'], 'required'],
            [['stock', 'order_show'], 'integer'],
            [['name', 'price', 'description'], 'string', 'max' => 1000],
            [['image'], 'string', 'max' => 200],
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
            'price' => 'Price',
            'stock' => 'Stock',
            'description' => 'Description',
            'image' => 'Image',
            'order_show' => 'Order Show',
        ];
    }


    public  static function save_product_categories($product_cat_list, $id)
    {

        foreach ((array) $product_cat_list as $ct) {


            $h = new Product_has_category();
            $h->product_id = $id;
            $h->category_id = $ct;
            if (!$h->save()) {
                //print_r($h->getErrors());
                //exit();
            }



        }
    }

}
