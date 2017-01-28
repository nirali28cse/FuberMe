<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_info".
 *
 * @property integer $id
 * @property string $order_number
 * @property string $final_amount
 * @property string $total_amount
 * @property integer $user_id
 * @property string $customer_name
 * @property string $customer_email
 * @property string $customer_mobile_no
 * @property string $customer_address
 * @property string $customer_city
 * @property string $customer_state
 * @property string $customer_zip
 * @property string $delivery_method
 * @property string $payment_method
 * @property string $tax_in_percent
 * @property string $order_notes
 * @property integer $order_status
 * @property string $order_date_time
 */
class OrderInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'final_amount', 'total_amount', 'user_id', 'customer_name', 'customer_email', 'customer_mobile_no', 'customer_address', 'customer_city', 'customer_state', 'customer_zip', 'delivery_method', 'payment_method', 'order_status'], 'required'],
            [['id', 'user_id', 'order_status'], 'integer'],
            [['customer_address', 'order_notes'], 'string'],
            [['order_date_time'], 'safe'],
			['customer_email', 'email'],
			[
            'customer_city',
            'match', 'not' => true, 'pattern' => '/[^[a-zA-Z0-9_ ]*$]/',
			],
			[['customer_mobile_no'], 'number'],
			[['customer_zip'], 'number'],
			[['tax_in_percent'], 'number'],
			['customer_mobile_no', 'string', 'min' => 10, 'message' => 'Mobile Number should contain at least 10 digits.'],
			['customer_zip', 'string', 'min' => 5, 'message' => 'Zip code should contain at least 5 digits.'],
            [['order_number',  'customer_name', 'customer_email', 'delivery_method', 'payment_method'], 'string', 'max' => 500],
            [['customer_mobile_no', 'customer_city', 'customer_state', 'customer_zip'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_number' => 'Order Number',
            'final_amount' => 'Final Amount',
            'total_amount' => 'Total Amount',
            'user_id' => 'User ID',
            'customer_name' => 'Customer Name',
            'customer_email' => 'Customer Email',
            'customer_mobile_no' => 'Customer Mobile No',
            'customer_address' => 'Customer Address',
            'customer_city' => 'Customer City',
            'customer_state' => 'Customer State',
            'customer_zip' => 'Customer Zip',
            'delivery_method' => 'Delivery Method',
            'payment_method' => 'Payment Method',
            'tax_in_percent' => 'Tax In Percent',
            'order_notes' => 'Order Notes',
            'order_status' => 'Order Status',
            'order_date_time' => 'Order Date Time',
        ];
    }
}
