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
		
		// chef 
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
							</tr>';
							
									
										
				$emailcontent =$emailcontent .'<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;color: orange;" valign="top">Once your account is activated, use the links below to go get started:</td>
							</tr>

							
							<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top"><a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;" 
							href="https://www.youtube.com/watch?v=4j-TmkkvnhU&feature=youtu.be">Get Started As a FuberMe Chef - YouTube</a></td>
							</tr> ';
										

				$emailcontent =$emailcontent .	'<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
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
		$chef_contact_number=null;
		$customer_name=null;
		$customer_address=null;
		$customer_email=null;
		$customer_contact=null;
		$order_number=null;
		$order_notes=null;
		$order_item_info=null;
		$maxhead_up_time=null;
		$order_item=array();
		$head_up_time_array=array();
		
		$chef_contact_number = $model->mobile_number;
		$customer_name=$order_query->customer_name;
		$customer_address=$order_query->customer_address.','.$order_query->customer_city.','.$order_query->customer_zip;
		$customer_email=$order_query->customer_email;
		$customer_contact=$order_query->customer_mobile_no;
		$order_number=$order_query->order_number;
		$order_notes=$order_query->order_notes;


/* 		foreach($order_item_query as $orderitem){
		echo '<pre>';
print_r($orderitem);
exit; */

		foreach($order_item_query as $orderitem){
			
			$order_item[]= '<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td>
										'.$orderitem->itemInfo->name.' (Qty '.$orderitem->item_qty.' in $'.($orderitem->item_qty*$orderitem->item_price).')
									</td>				
							</tr>';
			$head_up_time_array[]=$orderitem->itemInfo->head_up_time;
			
		}

		
	//	}
		
		$order_item_info=implode(' ',$order_item);
		$maxhead_up_time=max($head_up_time_array);
		if($maxhead_up_time>59){
			$hours = floor($maxhead_up_time / 60);
			$min = $maxhead_up_time - ($hours * 60);
			$mins=null;
			if($min>1) $mins =$min.' Mins';
			$hours_ex='Hour';
			if($hours>1)$hours_ex='Hours';
			$maxhead_up_time=$hours.' '.$hours_ex.' '.$mins;
		}else{
			$maxhead_up_time=$maxhead_up_time.' Mins';
		} 

		
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
						'.$customer_email.'
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
						This order should be ready in '.$maxhead_up_time.' .

					</td>				
				</tr>
				
				<tr><td><p>&nbsp;</p></td></tr>
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td style="color: red;">
						Order Notes - '.$order_notes.' 
					</td>				
				</tr>
				
				<tr><td><p>&nbsp;</p></td></tr>
				
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top">
				<a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;"
				href="'.
				Yii::$app->urlManager->createAbsoluteUrl(
						['/site/redirectorder','from'=>'chef']
						)
				.'">Click Here To View Your Order Details</a>
				</td>
				</tr>

				
				<tr><td><p>&nbsp;</p></td></tr>
				
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

		//  send sms 	
		$sms_url="https://api-mapper.clicksend.com/http/v2/send.php";
		$request = "username=fuberme&key=C6B80D78-E856-54F7-01EA-A377CDEAB09B&method=http&to=".$chef_contact_number."&from=508-257-1499
		&message=You have received a new order ".$order_number." from FuberMe customer ".$customer_name.". Order should be ready in ".$maxhead_up_time.". Please check your email or FuberMe for more details.
		";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $sms_url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request); 
		$response = curl_exec($ch); 
		curl_close($ch); 
	/* 	echo '<pre>';
		print $response; 
		exit; */
		
		return $send_email=self::sendEmail($toemail,$subject,$emailcontent);
		
	}
		
	
	public static function Neworderinformcustomer($item_chef_id,$customer_user_id,$order_query,$order_item_query)
	{
/* 		
		echo 'Neworderinformcustomer';
		exit; */
		
		$model=Userdetail::findOne($customer_user_id);
		$toemail = $order_query->customer_email;
		$customer_name=null;
		$customer_address=null;
		$customer_contact=null;
		$order_number=null;
		$order_notes=null;
		$order_item_info=null;
		$maxhead_up_time=null;
		$order_item=array();
		$head_up_time_array=array();
		
		// $chef_user_id=$order_item_query->chef_user_id;
		$chef_info=Userdetail::findOne($item_chef_id);
		$chef_name=$chef_info->username;
		$chef_address=$chef_info->address.','.$chef_info->city.','.$chef_info->zipcode;
		$chef_email_id=$chef_info->email_id;
		$chef_contact=$chef_info->mobile_number;

		 foreach($order_item_query as $orderitem){
			$order_item[]= '<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td>
										'.$orderitem->itemInfo->name.' (Qty '.$orderitem->item_qty.' in $'.($orderitem->item_qty*$orderitem->item_price).')
									</td>				
							</tr>';
			$head_up_time_array[]=$orderitem->itemInfo->head_up_time;				
		 }
		
		$order_item_info=implode(' ',$order_item);
		$maxhead_up_time=max($head_up_time_array);
		$deliverymaxhead_up_time=$maxhead_up_time+30;
		
		if($deliverymaxhead_up_time>59){
			$hours1 = floor($deliverymaxhead_up_time / 60);
			$min1 = $deliverymaxhead_up_time - ($hours1 * 60);
			$mins1=null;
			if($min1>1) $mins1 =$min1.' Mins';
			$hours_ex1='Hour';
			if($hours1>1)$hours_ex1='Hours';
			$deliverymaxhead_up_time=$hours1.' '.$hours_ex1.' '.$mins1;
		}else{
			$deliverymaxhead_up_time=$deliverymaxhead_up_time.' Mins';
		} 
		

		
		if($maxhead_up_time>59){
			$hours = floor($maxhead_up_time / 60);
			$min = $maxhead_up_time - ($hours * 60);
			$mins=null;
			if($min>1) $mins =$min.' Mins';
			$hours_ex='Hour';
			if($hours>1)$hours_ex='Hours';
			$maxhead_up_time=$hours.' '.$hours_ex.' '.$mins;
		}else{
			$maxhead_up_time=$maxhead_up_time.' Mins';
		} 
		
		$order_number=$order_query->order_number;
		$order_notes=$order_query->order_notes;
		
		
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
						<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">Your order number is <span style="color: #38b662;">'.$order_number.'</span></td>
						</tr>
						

						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;color: #38b662;">
								Order Summary:
							</td>				
						</tr>
										
						'.$order_item_info.'
							
																	
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;">
								Your order will be ready after <span style="color: #38b662;">'.$maxhead_up_time.'</span>.
							</td>				
						</tr>
						
						<tr><td><p>&nbsp;</p></td></tr>
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="color: red;"> 
								Order Notes - '.$order_notes.' 
							</td>				
						</tr>
						
						<tr><td><p>&nbsp;</p></td></tr>
						
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
								'.$chef_email_id.'
							</td>				
						</tr>	
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td> <span class="glyphicon glyphicon-earphone"></span>
								'.$chef_contact.'
							</td>				
						</tr>

						<tr><td><p>&nbsp;</p></td></tr>
						
						<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top">
						<a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;"
						href="'.
						Yii::$app->urlManager->createAbsoluteUrl(
								['/site/redirectorder','from'=>'customer']
								)
						.'">Click Here To View Your Order Details</a>
						</td>
						</tr>

						
						<tr><td><p>&nbsp;</p></td></tr>
				
				
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
						<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top">Your order number is <span style="color: #38b662;">'.$order_number.'</span></td>
						</tr>
						

						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;color: #38b662;">
								Order Summary:
							</td>				
						</tr>
										
						'.$order_item_info.'
							
						<tr><td><p>&nbsp;</p></td></tr>	
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="color: red;">
								Order Notes - '.$order_notes.' 
							</td>				
						</tr>
						
						<tr><td><p>&nbsp;</p></td></tr>
								
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td style="padding: 12px 0;">
								Your order will be ready after <span style="color: #38b662;">'.$maxhead_up_time.'</span>.
							</td>				
						</tr>
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td>
								Your food item will be delivered in <span style="color: #38b662;">'.$deliverymaxhead_up_time.'</span> by <span style="color: #38b662;">'.$chef_name.'</span>
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
								'.$chef_email_id.'
							</td>				
						</tr>	
						
						<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td> <span class="glyphicon glyphicon-earphone"></span>
								'.$chef_contact.'
							</td>				
						</tr>

						<tr><td><p>&nbsp;</p></td></tr>
						
						<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td class="content-block" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0px; padding: 0px 0px 20px; text-align: center;" valign="top">
						<a class="btn-primary" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #38b662; margin: 0; border-color: #38b662; border-style: solid; border-width: 10px 20px;"
						href="'.
						Yii::$app->urlManager->createAbsoluteUrl(
								['/site/redirectorder','from'=>'customer']
								)
						.'">Click Here To View Your Order Details</a>
						</td>
						</tr>

						
						<tr><td><p>&nbsp;</p></td></tr>
						
						
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
		
	
	
	
	public static function Neworderinformfuberadmin($item_chef_id,$order_query,$order_item_query)
	{
		
		
		$chef_info=Userdetail::findOne($item_chef_id);
		$chef_name=$chef_info->username.'('.$chef_info->email_id.','.$chef_info->mobile_number.')';
		$final_amount=0;
		$customer_name=null;
		$order_notes=null;
		$order_number=0;
		$final_amount=$order_query->final_amount;
		$customer_name=$order_query->customer_name.','.$order_query->customer_email.','.$order_query->customer_mobile_no;
		$order_number=$order_query->order_number;
		$order_notes=$order_query->order_notes;
		
		$toemail = Yii::$app->params['adminemailid'];
		
		$order_item_info=null;
		foreach($order_item_query as $orderitem){
			$order_item[]= '<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
									<td>
										'.$orderitem->itemInfo->name.' (Qty '.$orderitem->item_qty.' in $'.($orderitem->item_qty*$orderitem->item_price).')
									</td>				
							</tr>';
			$head_up_time_array[]=$orderitem->itemInfo->head_up_time;				
		 }
		
		$order_item_info=implode(' ',$order_item);
		
		
		
		$subject = 'New Order Placed';		
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
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">A new order is just placed by:&nbsp;</td>
				</tr>
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td class="content-block" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
				<p>From Customer : &nbsp; '.$customer_name.'</p>
				<p>To Chef : &nbsp; '.$chef_name.'</p>
				<p>Order Amount : &nbsp; $'.$final_amount.'</p>
				<p style="color: red;">Order Notes : &nbsp; '.$order_notes.'</p>
				</td>
				</tr>
				
				<tr><td><p>&nbsp;</p></td></tr>
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td>
						Order #'.$order_number.' 
					</td>				
				</tr>
				
				<tr><td><p>&nbsp;</p></td></tr>
				
				<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
					<td style="padding: 12px 0;color: #38b662;">
						Order Summary:
					</td>				
				</tr>
								
				'.$order_item_info.'
					
				<tr><td><p>&nbsp;</p></td></tr>	
						
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