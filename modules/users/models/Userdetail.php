<?php

namespace app\modules\users\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $auth_key
 * @property string $create_at
 * @property string $lastvisit_at
 * @property integer $superuser
 * @property integer $status
 * @property integer $is_agree_with_terms_conditions
 * @property integer $is_employeer
 * @property integer $is_job_seeker
 * @property integer $is_seller
 * @property integer $is_advertiser
 */


class Userdetail extends \yii\db\ActiveRecord implements IdentityInterface
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
            [['username', 'mobile_number', 'email_id','city','state', 'zipcode', 'password', 'address', 'delivery_method', 'payment_method'], 'required'],
            ['is_aggree_with_terms_condition', 'required', 'requiredValue' => 1, 'message' => 'Agree terms and condition'],
			[['address'], 'string'],
            [['zipcode'], 'number'],
            [['user_type', 'is_aggree_with_terms_condition','is_admin', 'status'], 'integer'],
            [['username', 'email_id', 'city', 'state', 'delivery_method', 'payment_method'], 'string', 'max' => 100],
          //  [['mobile_number'], 'number'],
		//	['email_id', 'unique', 'targetAttribute' => ['email_id'], 'message' => 'This email already taken.'],
			['email_id', 'email'],
			['paypal_email', 'email'],
            [['image_path', 'auth_key'], 'string', 'max' => 500],
			[
            'city',
            'match', 'not' => true, 'pattern' => '/[^[a-zA-Z0-9_ ]*$]/',
			],

			[
            'mobile_number',
            'match', 'not' => true, 'pattern' => '/[^0-9_-]/',
			],
			['paypal_email', 'required', 'when' => function($model) {
					return $model->payment_method == 'paypal';
				}, 'whenClient' => "function (attribute, value) {
						  return $('#userdetail-payment_method').val() == 'paypal';
						}"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Name',
            'mobile_number' => 'Mobile Number',
            'email_id' => 'Email ( This will be your login id )',
            'paypal_email' => 'Paypal Email',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'zipcode' => 'Zip',
            'user_type' => 'User Type',
            'delivery_method' => 'Delivery Method',
            'payment_method' => 'Payment Method',
            'image_path' => 'Image Path',
            'auth_key' => 'Auth Key',
            'is_aggree_with_terms_condition' => 'I agree to the terms and conditions',
            'date_time' => 'Date Time',
            'is_admin' => 'Is Admin',
            'status' => 'Status',
        ];
    }
	
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
        /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
/* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }
 
/* removed
    public static function findIdentityByAccessToken($token)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
*/
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($email_id)
    {
        return static::findOne(['email_id' => $email_id]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === MD5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /** EXTENSION MOVIE **/

	
	
}
