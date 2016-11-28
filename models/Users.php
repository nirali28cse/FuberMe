<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $mobile_number
 * @property string $email_id
 * @property string $address
 * @property string $city
 * @property string $zipcode
 * @property integer $user_type
 * @property string $delivery_method
 * @property string $payment_method
 * @property string $image_path
 * @property string $auth_key
 * @property integer $is_aggree_with_terms_condition
 * @property string $date_time
 * @property integer $is_admin
 * @property integer $status
 *
 * @property ItemCategoryInfo[] $itemCategoryInfos
 * @property ItemInfo[] $itemInfos
 * @property OrderInfo[] $orderInfos
 * @property OrderItemInfo[] $orderItemInfos
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mobile_number', 'password', 'email_id', 'city', 'zipcode', 'auth_key', 'date_time'], 'required'],
            [['address'], 'string'],
            [['zipcode'], 'number'],
            [['user_type', 'is_aggree_with_terms_condition', 'is_admin', 'status'], 'integer'],
            [['date_time'], 'safe'],
            [['name', 'email_id', 'city', 'delivery_method', 'payment_method'], 'string', 'max' => 100],
            [['mobile_number'], 'string', 'max' => 10],
            [['image_path', 'auth_key'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mobile_number' => 'Mobile Number',
            'password' => 'Password',
            'email_id' => 'Email ID',
            'address' => 'Address',
            'city' => 'City',
            'zipcode' => 'Zipcode',
            'user_type' => 'User Type',
            'delivery_method' => 'Delivery Method',
            'payment_method' => 'Payment Method',
            'image_path' => 'Image Path',
            'auth_key' => 'Auth Key',
            'is_aggree_with_terms_condition' => 'Is Aggree With Terms Condition',
            'date_time' => 'Date Time',
            'is_admin' => 'Is Admin',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategoryInfos()
    {
        return $this->hasMany(ItemCategoryInfo::className(), ['chef_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemInfos()
    {
        return $this->hasMany(ItemInfo::className(), ['chef_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderInfos()
    {
        return $this->hasMany(OrderInfo::className(), ['customer_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemInfos()
    {
        return $this->hasMany(OrderItemInfo::className(), ['item_chef_user_id' => 'id']);
    }
}
