<?php

namespace app\models;

use Yii;
use app\models\DietaryPreference;
use app\models\ItemCategoryInfo;
use app\models\CuisineTypeInfo;



/**
 * This is the model class for table "item_info".
 *
 * @property integer $id
 * @property integer $chef_user_id
 * @property string $name
 * @property string $price
 * @property integer $item_category_info_id
 * @property integer $item_cuisine_type_info_id
 * @property string $ingredients
 * @property string $description
 * @property string $delivery_method
 * @property string $head_up_time
 * @property string $availability_from_date
 * @property string $availability_to
 * @property string $date_time
 * @property integer $status
 *
 * @property ItemImages[] $itemImages
 * @property Users $chefUser
 * @property OrderItemInfo[] $orderItemInfos
 */
class ItemInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chef_user_id', 'name', 'price', 'delivery_method', 'item_cuisine_type_info_id','item_dietary_preference', 'item_category_info_id','head_up_time','availability_from_date', 'availability_to_date', 'availability_from_time', 'availability_to_time'], 'required', 'message' => '{attribute} is required'],
            [['chef_user_id', 'item_category_info_id', 'item_cuisine_type_info_id', 'status'], 'integer'],
            [['ingredients', 'description'], 'string'],
            [['date_time'], 'safe'],
		//	[['price'], 'number'],
			[['price'],'number','numberPattern' => '/^\d+(.\d{1,2})?$/','message'=>'Enter a valid Price up to two decimal places.'],
            [['name','ingredients', 'description'], 'string', 'max' => 500],
			[['quantity'],'integer','message'=>'Enter a valid Quntity in number.'],
			['price', 'compare', 'compareValue' => 100, 'operator' => '<=', 'type' => 'number','message'=>'Enter a valid Price up to $100'],
			[['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,jpeg,gif,png'],
            [['delivery_method', 'head_up_time', 'availability_from_date', 'availability_to_date', 'availability_from_time', 'availability_to_time'], 'string', 'max' => 100],
            [['chef_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['chef_user_id' => 'id']],
			[['availability_to_date', 'availability_from_date'], 'date', 'format' => 'php:Y-m-d'],
			['availability_to_date', 'compare', 'compareAttribute' => 'availability_from_date','message'=>'Enter a valid end date that is after the start date.', 'operator' => '>='],
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chef_user_id' => 'Chef User ID',
            'name' => 'Name',
            'price' => 'Price',
            'item_category_info_id' => 'Category',
            'item_cuisine_type_info_id' => 'Cuisine',
            'item_dietary_preference' => 'Dietary Preference',
            'ingredients' => 'Ingredients',
            'description' => 'Description',
            'delivery_method' => 'Delivery Method',
            'head_up_time' => 'Preparation Time',
            'availability_from_date' => 'Available FROM',
            'availability_from_time' => 'From Time',
            'availability_to_date' => 'TO',
            'availability_to_time' => 'To Time',
            'date_time' => 'Date Time',
            'status' => 'Status',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChefUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'chef_user_id']);
    }   

	public function getItemCategoryInfo()
    {
        return $this->hasOne(ItemCategoryInfo::className(), ['id' => 'item_category_info_id']);
    } 

	public function getCuisineTypeInfo()
    {
        return $this->hasOne(CuisineTypeInfo::className(), ['id' => 'item_cuisine_type_info_id']);
    }
	
	public function getDietaryPreference()
    {
        return $this->hasOne(DietaryPreference::className(), ['id' => 'item_dietary_preference']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


}
