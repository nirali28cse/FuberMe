<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuisine_type_info".
 *
 * @property integer $id
 * @property string $name
 * @property integer $chef_user_id
 * @property integer $status
 * @property string $date_time
 *
 * @property Users $chefUser
 */
class CuisineTypeInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuisine_type_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name' ,'status'], 'required'],
            [['chef_user_id', 'status'], 'integer'],
            [['date_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['chef_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['chef_user_id' => 'id']],
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
            'chef_user_id' => 'Chef User ID',
            'status' => 'Status',
            'date_time' => 'Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChefUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'chef_user_id']);
    }
}
