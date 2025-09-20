<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "_address".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address
 */
class Address extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'address'], 'required'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 2000],
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
            'name' => 'Name',
            'address' => 'Address',
        ];
    }

}
