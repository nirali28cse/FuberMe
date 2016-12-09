<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_images".
 *
 * @property integer $id
 * @property integer $item_info_id
 * @property string $image_path
 * @property string $date_time
 *
 * @property ItemInfo $itemInfo
 */
class ItemImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_info_id', 'image_path'], 'required'],
            [['item_info_id'], 'integer'],
            [['date_time'], 'safe'],
            [['image_path'], 'string', 'max' => 500],
            [['item_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemInfo::className(), 'targetAttribute' => ['item_info_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_info_id' => 'Item Info ID',
            'image_path' => 'Image Path',
            'date_time' => 'Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemInfo()
    {
        return $this->hasOne(ItemInfo::className(), ['id' => 'item_info_id']);
    }
}
