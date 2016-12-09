<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usa_state".
 *
 * @property integer $id
 * @property string $name
 * @property string $state_code
 * @property integer $status
 */
class UsaState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usa_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'state_code'], 'required'],
            [['status'], 'integer'],
            [['name', 'state_code'], 'string', 'max' => 100],
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
            'state_code' => 'State Code',
            'status' => 'Status',
        ];
    }
}
