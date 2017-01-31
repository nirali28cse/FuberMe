<?php

namespace app\models;

use Yii;
use app\models\ItemInfo;

/**
 * This is the model class for table "order_item_info".
 *
 * @property integer $id
 * @property integer $order_info_id
 * @property integer $item_id
 * @property integer $item_qty
 * @property string $item_price
 * @property integer $item_chef_user_id
 * @property string $date_time
 */
class OrderItemInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_info_id', 'item_id', 'item_qty', 'item_price', 'item_chef_user_id'], 'required'],
            [['order_info_id', 'item_id', 'item_qty', 'item_chef_user_id'], 'integer'],
            [['date_time'], 'safe'],
            [['item_price'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_info_id' => 'Order Info ID',
            'item_id' => 'Item ID',
            'item_qty' => 'Item Qty',
            'item_price' => 'Item Price',
            'item_chef_user_id' => 'Item Chef User ID',
            'date_time' => 'Date Time',
        ];
    }
	
	
	
	public function getItemInfo()
    {
        return $this->hasOne(ItemInfo::className(), ['id' => 'item_id']);
    }
	
	
}
