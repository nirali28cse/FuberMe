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
		$subject = 'Welcome to FuberMe. Your account activation link';
		
		// customer
		if($model->user_type==1){
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
							<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thank you for registering with FuberMe. Click on the link below to activate your account:</td>
							</tr>

							
							<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top"><a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;" 
							href="'.
							Yii::$app->urlManager->createAbsoluteUrl(
									['site/confirm','id'=>$model->id,'key'=>$model->auth_key]
									)
							.'">Confirm Email</a></td>
							</tr>
	
							<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Please contact FuberMe team if you have any questions or trouble signing in</td>
							</tr>
							
							<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box;color: gray; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">email@fuberme.com | Contact Us | 508-257-1499</td>
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
		}
		
		// cheif 
		if($model->user_type==2){
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
							<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Thank you for registering as a Chef with FuberMe. Click link below to activate your account:</td>
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
							<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;color: orange;" valign="top">Once your account is activated, use the links below to go get started:</td>
							</tr>

							
							<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top"><a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;" 
							href="#">Start Now</a></td>
							</tr>
										

							<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;color: #38b662;" valign="top">Get ready to wow the world with your special recipes!</td>
							</tr>
							
							<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Please contact FuberMe team if you have any questions or trouble signing in</td>
							</tr>
							
							<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box;color: gray; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">email@fuberme.com | Contact Us | 508-257-1499</td>
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
		}
		
	
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
	
	public static function Forgetpasswordresetlink($user_id)
	{
		$model=Userdetail::findOne($user_id);
		$toemail = $model->email_id;

		$subject = 'Your FuberMe account reset link';		
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
				<td class="alert alert-warning" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #ff9f00; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#FF9F00">Please use link below to reset your FuberMe account password.</td>
				</tr>

				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
				
				<table style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>

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

				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Please contact FuberMe team if you have any questions or trouble with your account</td>
				</tr>
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box;color: gray; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">email@fuberme.com | Contact Us | 508-257-1499</td>
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

	
	
	public static function Neworderinformchef($chef_user_id,$order_query,$order_item_query)
	{
		$model=Userdetail::findOne($chef_user_id);
		$toemail = $model->email_id;
		$customer_name=null;
		$customer_address=null;
		$customer_contact=null;
		$order_number=null;
		$order_item_info=null;
		$maxhead_up_time=null;
		$order_item=array();
		$head_up_time_array=array();
		
		$customer_name=$order_query->customer_name;
		$customer_address=$order_query->customer_address.','.$order_query->customer_city.','.$order_query->customer_zip;
		$customer_contact=$order_query->customer_email.','.$order_query->customer_mobile_no;
		$order_number=$order_query->order_number;
		
		foreach($order_item_query as $order_item){
			$order_item[]= '<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td>
										'.$order_item->itemInfo->name.' (Qty '.$orderitem->item_qty.' in $'.$orderitem->item_price.')
									</td>				
							</tr>';
			$head_up_time_array[]=$order_item->itemInfo->head_up_time;				
		}
		
		$order_item_info=implode(' ',$order_item);
		$maxhead_up_time=max($head_up_time_array);
		
		
		$subject = 'Congratulations! You have received a new order from FuberMe';		
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
				<td class="alert alert-warning" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #ff9f00; margin: 0; padding: 20px;" align="center" valign="top" bgcolor="#FF9F00">Congratulations! You have received a new order from FuberMe</td>
				</tr>
				
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-wrap" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
				
				<table style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td style="padding: 12px 0;color: #38b662;">
						Foodie Details:
					</td>				
				</tr>
								
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td>
						'.$customer_name.'
					</td>				
				</tr>	
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td>
						'.$customer_address.'
					</td>				
				</tr>
									
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td>
						'.$customer_contact.'
					</td>				
				</tr>
					
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td style="padding: 12px 0; color: #38b662;">
						Order details -
					</td>				
				</tr>
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td>
						Order #'.$order_number.' 
					</td>				
				</tr>

											
				'.$order_item_info.'
															
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td style="padding: 12px 0;color: #38b662;">
						This order should be ready in '.$maxhead_up_time.' Mins.

					</td>				
				</tr>
				

				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Please contact FuberMe team immediately if you are not able to fulfil this order or have any questions.</td>
				</tr>
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box;color: gray; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">email@fuberme.com | Contact Us | 508-257-1499</td>
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
		
	
	public static function Neworderinformcustomer($customer_user_id,$order_query,$order_item_query)
	{
		$model=Userdetail::findOne($customer_user_id);
		$toemail = $model->email_id;
		$customer_name=null;
		$customer_address=null;
		$customer_contact=null;
		$order_number=null;
		$order_item_info=null;
		$maxhead_up_time=null;
		$order_item=array();
		$head_up_time_array=array();
		
		$chef_user_id=$order_query->chef_user_id;
		$chef_info=Userdetail::findOne($chef_user_id);
		$chef_name=$chef_info->username;
		$chef_address=$chef_info->address.','.$chef_info->city.','.$chef_info->zipcode;
		$chef_contact=$chef_info->email_id.','.$chef_info->mobile_number;

		foreach($order_item_query as $order_item){
			$order_item[]= '<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td>
										'.$order_item->itemInfo->name.' (Qty '.$orderitem->item_qty.' in $'.$orderitem->item_price.')
									</td>				
							</tr>';
			$head_up_time_array[]=$order_item->itemInfo->head_up_time;				
		}
		
		$order_item_info=implode(' ',$order_item);
		$maxhead_up_time=max($head_up_time_array);
		$deliverymaxhead_up_time=$maxhead_up_time+30;
		
		
		
		
		$subject = 'Your FuberMe order has been placed';	

		//for delivery method pickup		
		if($order_query->delivery_method=='pickup'){
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
						<p>Thank you for your recent order with FuberMe.</p>
						</td>
						</tr>
						<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-wrap" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 20px; width: 527px;" valign="top">
						<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
						<tbody>
						<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Your order number is <span style="color: #38b662;">xxxxxxxx</span></td>
						</tr>
						

						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;color: #38b662;">
								Order Summary:
							</td>				
						</tr>
										
						'.$order_item_info.'
							
																	
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;">
								Your order will be ready after <span style="color: #38b662;">'.$maxhead_up_time.' Mins</span>.
							</td>				
						</tr>
							
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0; color: #38b662;">
								Order Pick Up Address:
							</td>				
						</tr>
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								'.$chef_name.'
							</td>				
						</tr>	
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								'.$chef_address.'
							</td>				
						</tr>		
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								'.$chef_contact.'
							</td>				
						</tr>

						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 10 0 20px;" valign="top">Please contact FuberMe team if you have any questions or trouble signing in</td>
						</tr>
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box;color: gray; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">email@fuberme.com | Contact Us | 508-257-1499</td>
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
		}
		
		//for delivery method ome delivery
		if($order_query->delivery_method=='homedelivery'){
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
						<p>Thank you for your recent order with FuberMe.</p>
						</td>
						</tr>
						<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-wrap" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 20px; width: 527px;" valign="top">
						<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" width="100%" cellspacing="0" cellpadding="0">
						<tbody>
						<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">Your order number is <span style="color: #38b662;">xxxxxxxx</span></td>
						</tr>
						

						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;color: #38b662;">
								Order Summary:
							</td>				
						</tr>
										
						'.$order_item_info.'
							
																	
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;">
								Your order will be ready after <span style="color: #38b662;">'.$maxhead_up_time.' Mins</span>.
							</td>				
						</tr>
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								Your food item will be delivered in <span style="color: #38b662;">'.$deliverymaxhead_up_time.' Mins</span> by <span style="color: #38b662;">'.$chef_name.'</span>
							</td>				
						</tr>
							
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0; color: #38b662;">
								Chef Address:
							</td>				
						</tr>
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								'.$chef_name.'
							</td>				
						</tr>	
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								'.$chef_address.'
							</td>				
						</tr>		
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								'.$chef_contact.'
							</td>				
						</tr>

						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 10 0 20px;" valign="top">Please contact FuberMe team if you have any questions/suggestions or need help.</td>
						</tr>
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box;color: gray; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">email@fuberme.com | Contact Us | 508-257-1499</td>
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
		}
		
			
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