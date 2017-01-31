<?php

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\modules\users\models\Userdetail;


class Emailfunction extends Component
{

	public static function sendEmail($toemail,$subject,$emailcontent)
	{
		$htmlBody='<center>FuberMe</center>';	
		$htmlBody=$htmlBody.$emailcontent;
		
		try
		{
			$emailSend = Yii::$app->mailer->compose()
				->setFrom([Yii::$app->params['adminemailid'] => 'FuberMe'])
				->setTo($toemail)
			 // ->setCc($model->email_2)
				->setSubject($subject)
			 // ->setTextBody('This is Plain text content')
				->setHtmlBody($htmlBody)
			 // ->attach($model->attachment)
				->send();
			
			return $emailSend;	
        }
        catch(\Swift_TransportException $exception)
        {
			$response = $exception->getMessage() ;
			echo '<pre>';
            print_r($response);
			exit;
        }		

	}	

	public static function Userregistrationverification($user_id)
	{
		$model=Userdetail::findOne($user_id);
		$toemail = $model->email_id;

		$subject = 'Signup Confirmation';
		
		$emailcontent = "Click this link ".\yii\helpers\Html::a('confirm',
						Yii::$app->urlManager->createAbsoluteUrl(
						['site/confirm','id'=>$model->id,'key'=>$model->auth_key]
						));			
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
	
	
	public static function Chefinformlessqty($chef_user_id)
	{
		$model=Userdetail::findOne($chef_user_id);
		$toemail = $model->email_id;

		$subject = 'Less Qty Of Item';		
		$emailcontent = "This Mail is for inform you that qty of your item is less then 2.";			
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
	
}

   
?>