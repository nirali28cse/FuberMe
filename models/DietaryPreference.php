<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dietary_preference".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $date_time
 */
class DietaryPreference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dietary_preference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','status'], 'required', 'message' => '{attribute} is required'],
            [['status'], 'integer'],
            [['date_time'], 'safe'],
            [['name'], 'string', 'max' => 500],
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
            'status' => 'Status',
            'date_time' => 'Date Time',
        ];
    }
}
