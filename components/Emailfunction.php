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
		$htmlBody='';	
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
		$emailcontent = '		
		<html>
			<body>
				<p>&nbsp;</p>
				<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://34.195.26.140/fuberme/images/whitelogo.png" alt="Fuberme" width="200" height="82" /></p>
				<p>&nbsp;</p>
				<table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#38b662">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				<td class="container" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top" width="600">
				<div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="alert alert-warning" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #ffffff; font-weight: 500; text-align: center; border-radius: 3px 3px 0px 0px; background-color: #38b662; margin: 0px; padding: 20px; width: 527px;" align="center" valign="top" bgcolor="#38b662">
				<p>Welcome to Fuberme.</p>
				</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 20px; width: 527px;" valign="top">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">You are one step far from world of amazing homemade food.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Please confirm your email address to allow us to mark you as an authentic user. This is a first step to a painless journey of selecting and ordering your homemade food.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top"><a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;" 
				href="'.
				Yii::$app->urlManager->createAbsoluteUrl(
						['site/confirm','id'=>$model->id,'key'=>$model->auth_key]
						)
				.'">Confirm Email</a></td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thanks for choosing Fuberme.</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="aligncenter content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Disclaimer: we will save your email for various notifications.</td>
				</tr>
				</tbody>
				</table>
				</div>
				</div>
				</td>
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				</tr>
				</tbody>
				</table>
			</body>
		 </html>
		';			
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
	
	public static function Forgetpasswordresetlink($user_id)
	{
		$model=Userdetail::findOne($user_id);
		$toemail = $model->email_id;

		$subject = 'Reset Password';		
		$emailcontent = '
		<html>
			<body>
				<p>&nbsp;</p>
				<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://34.195.26.140/fuberme/images/whitelogo.png" alt="Fuberme" width="200" height="82" /></p>
				<p>&nbsp;</p>
				<table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#38b662">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				<td class="container" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top" width="600">
				<div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="alert alert-warning" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #ffffff; font-weight: 500; text-align: center; border-radius: 3px 3px 0px 0px; background-color: #38b662; margin: 0px; padding: 20px; width: 527px;" align="center" valign="top" bgcolor="#38b662">
				<p>Forgot your password?</p>
				</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 20px; width: 527px;" valign="top">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">To reset your password, click on the button given below.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Do not share this link with anyone. Do not reply to this email.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top">
				<a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;"
				href="'.
				Yii::$app->urlManager->createAbsoluteUrl(
						['/users/forgotpassword/index2','resetid'=>$model->id,'key'=>$model->auth_key]
						)
				.'">Click Here To Reset Your Password</a>
				</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thanks for choosing Fuberme.</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="aligncenter content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Disclaimer: we will save your email for various notifications.</td>
				</tr>
				</tbody>
				</table>
				</div>
				</div>
				</td>
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				</tr>
				</tbody>
				</table>
			</body>
		 </html>
		';
		
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}

	

	
	public static function Chefinformlessqty($chef_user_id)
	{
		$model=Userdetail::findOne($chef_user_id);
		$toemail = $model->email_id;

		$subject = 'Less Item Qty';		
		$emailcontent = '
		
		<html>
			<body>
				<p>&nbsp;</p>
				<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://34.195.26.140/fuberme/images/whitelogo.png" alt="Fuberme" width="200" height="82" /></p>
				<p>&nbsp;</p>
				<table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				<td class="container" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top" width="600">
				<div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="alert alert-warning" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #ff9f00; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#FF9F00">Warning: You\'re approaching your dish limit. Please add more dishes.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">You have <strong style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">2 Dishes&nbsp;</strong>remaining.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Add more&nbsp;quantity to allow users to browse through your dish. Your dish will be taken offline if quantity exhausts.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top"><a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;" 
				href="'.Yii::$app->params["http_url"].'">
				Upgrade Quantity</a></td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thanks for choosing&nbsp;FuberMe.</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="aligncenter content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top"><a style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;" href="http://www.fuberme.com">Unsubscribe</a> from these alerts.</td>
				</tr>
				</tbody>
				</table>
				</div>
				</div>
				</td>
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				</tr>
				</tbody>
				</table>
			</body>
		 </html>
		';			
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
		
	
	public static function Neworderinformchef($chef_user_id)
	{
		$model=Userdetail::findOne($chef_user_id);
		$toemail = $model->email_id;

		$subject = 'New Order place for Your Item';		
		$emailcontent = '
		<html>
			<body>
				<p>&nbsp;</p>
				<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://34.195.26.140/fuberme/images/whitelogo.png" alt="Fuberme" width="200" height="82" /></p>
				<p>&nbsp;</p>
				<table class="body-wrap" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
				<tbody>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				<td class="container" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top" width="600">
				<div class="content" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff">
				<tbody>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="alert alert-warning" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #ff9f00; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#FF9F00">Alert: You\'ve&nbsp;received a new order.</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
				<table style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">You have a&nbsp;<strong style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">New Order&nbsp;</strong>.</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Someone just placed an order with you. Check what do they demand.</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top"><a class="btn-primary" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;" 
				href="'.Yii::$app->params["http_url"].'">Check Order Status</a></td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thanks for choosing&nbsp;FuberMe.</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<div class="footer" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
				<table style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%">
				<tbody>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="aligncenter content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top"><a style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;" href="http://www.fuberme.com">Unsubscribe</a> from these alerts.</td>
				</tr>
				</tbody>
				</table>
				</div>
				</div>
				</td>
				<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				</tr>
				</tbody>
				</table>
			</body>
		 </html>
		';			
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
		
	
	public static function Neworderinformcustomer($customer_user_id)
	{
		$model=Userdetail::findOne($customer_user_id);
		$toemail = $model->email_id;

		$subject = 'Order Place Sucessfully';		
		$emailcontent = '
			<html>
			<body>
				<p>&nbsp;</p>
				<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://34.195.26.140/fuberme/images/whitelogo.png" alt="Fuberme" width="200" height="82" /></p>
				<p>&nbsp;</p>
				<table class="body-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#38b662">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				<td class="container" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top" width="600">
				<div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="alert alert-warning" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #ffffff; font-weight: 500; text-align: center; border-radius: 3px 3px 0px 0px; background-color: #38b662; margin: 0px; padding: 20px; width: 527px;" align="center" valign="top" bgcolor="#38b662">
				<p>Confirmation: Your order was placed successfully.</p>
				</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 20px; width: 527px;" valign="top">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Chef recieved your order and your dish(es) is getting prepared.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Our Chef\'s offer fresh homemade food and it takes a specific headsup time to make it taste the way you prefer. Our chef will get in touch once your order is ready to deliver.</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top">&nbsp;</td>
				</tr>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thanks for choosing Fuberme.</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
				<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%">
				<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

				</tr>
				</tbody>
				</table>
				</div>
				</div>
				</td>
				<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				</tr>
				</tbody>
				</table>
			</body>
		 </html>
		';			
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}	
	
	public static function Neworderinformfuberadmin()
	{
		
		$toemail = Yii::$app->params['adminemailid'];

		$subject = 'New Order place';		
		$emailcontent = '
		<html>
			<body>
				<p>&nbsp;</p>
				<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://34.195.26.140/fuberme/images/whitelogo.png" alt="Fuberme" width="200" height="82" /></p>
				<p>&nbsp;</p>
				<table class="body-wrap" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#38b662">
				<tbody>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				<td class="container" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top" width="600">
				<div class="content" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff">
				<tbody>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="alert alert-warning" style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #ffffff; font-weight: 500; text-align: center; border-radius: 3px 3px 0px 0px; background-color: #38b662; margin: 0px; padding: 20px; width: 527px;" align="center" valign="top" bgcolor="#38b662">
				<p>New Order Placed</p>
				</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 20px; width: 527px;" valign="top">
				<table style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">A new order as just placed by:&nbsp;</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
				<p>For Chef:&nbsp;</p>
				<p>Amounting to:&nbsp;</p>
				</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top">&nbsp;</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">&nbsp;</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<div class="footer" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">&nbsp;</div>
				</div>
				</td>
				<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">&nbsp;</td>
				</tr>
				</tbody>
				</table>
			</body>
		 </html>
		';			
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
	
	
	
	
}

   
?>