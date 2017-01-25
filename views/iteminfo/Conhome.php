<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

?>
<style>
.sorterclass{
	list-style-type: none;
	overflow: hidden;
}
.sorterclass a{
	color: #38b662;
    text-decoration: none;
    float: left;
    padding: 10px;
}	

.active{
	color: #38b662;
	font-weight: 500;
}
.rclose{
	color: gray;
    font-size: 11px;
    float: right;
}

.rclose:hover, .rclose:focus {
    color: #E74C3C;
    text-decoration: underline;
}
</style>

<div class="product-model">	 
	 <div class="container">
	 
	 
<?php 
/* 		<ol class="breadcrumb">
		  <li><a href="index.html">Home</a></li>
		  <li class="active">Adipiscing Enfsjs</li>
		</ol>  */
 ?>
		 
		 
		<h2>Order Your food</h2>			
		 <div class="col-md-9 product-model-sec">
						<?php					
						 echo  ListView::widget([
								'layout' => "{sorter}\n{summary}\n{items}\n{pager}",								
								'dataProvider' => $dataProvider,
							    'sorter' => [
									'options' => [
										'class' => 'sorterclass',
									],
								],
								'emptyText' => '<center><h2>No dishes Found.</h2></center>',
								'itemOptions' => ['class' => 'item'],
						/*         'itemView' => function ($model, $key, $index, $widget) {
										return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
								}, */
							//	'itemView' =>'view'	,
										
								'itemView' => function ($model) {
								  // echo $id = $model->id;
									
									 return $this->render('_viewcon',['model' => $model]);
									// return $this->render('_view');
								}
								
						]); 
						?>
		 </div>
			
			
			
			<div class="rsidebar span_1_of_left">
			
				 
				<?php $item_cuisine_type_info_ids = app\models\CuisineTypeInfo::find()->where(['status'=>1])->all(); ?> 
				<?php if(count($item_cuisine_type_info_ids)>0){ ?>							
					<section  class="sky-form">
						 <h4><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>&nbsp; Cuisine</h4>
						 <div class="row">
							 <div class="col col-4">						 
							 <?php foreach($item_cuisine_type_info_ids as $item_cuisine_type_info_id){ 
									$activecous=null;
									$removecous=null;
									if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['cusion']>0 and $_SESSION['filetrsarray']['cusion']==$item_cuisine_type_info_id->id){
										$activecous='class="active"';
										$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcusion=1" class="rclose">remove</a>';
									} 
							 ?>	
									<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&cusion=<?php echo $item_cuisine_type_info_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_cuisine_type_info_id->name; ?></a>
									<?php echo $removecous; ?></label>								 
							 <?php } ?>			
							 </div>
						 </div>
					 </section> 	
				<?php } ?>						 
				 
				 <section  class="sky-form">
					 <h4><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp; Price</h4>
					 <div class="row row1 scroll-pane">
						 <div class="col col-4">
						 <?php
						 $active75=null;
						 $active57=null;
						 $active25=null;
						 $active02=null;
						 $removeprice75=null;
						 $removeprice57=null;
						 $removeprice25=null;
						 $removeprice02=null;
						 $removeprice=null;
						 $removeprice='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcusion=1" class="rclose">remove</a>'; 
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['price']>0 and $_SESSION['filetrsarray']['price']==75){ $active75='class="active"';$removeprice75=$removeprice; }
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['price']>0 and $_SESSION['filetrsarray']['price']==57){ $active57='class="active"'; $removeprice57=$removeprice; }
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['price']>0 and $_SESSION['filetrsarray']['price']==25){ $active25='class="active"';$removeprice25=$removeprice; }
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['price']>0 and $_SESSION['filetrsarray']['price']==02){ $active02='class="active"';$removeprice02=$removeprice; }
						 ?>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&price=75" <?php echo $active75; ?>>Above $75</a> <?php echo $removeprice75; ?></label>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&price=57" <?php echo $active57; ?>>$50 - $75</a> <?php echo $removeprice57; ?></label>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&price=25" <?php echo $active25; ?>>$25 - $50</a> <?php echo $removeprice25; ?></label>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&price=02" <?php echo $active02; ?>>$5 - $25</a> <?php echo $removeprice02; ?></label>								
						 </div>
					 </div>
				 </section> 

<?php

/* function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
 $PublicIP = get_client_ip(); 
 $json  = file_get_contents("https://freegeoip.net/json/$PublicIP");
 $json  =  json_decode($json ,true);


function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
      return $miles;
  }
}

echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>"; */


?>
				 <section  class="sky-form">
					 <h4><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp; Near By You</h4>
					 <div class="row row1 scroll-pane">
						 <div class="col col-4">
						 <?php
						 $active51=null;
						 $active15=null;
						 $active57=null;
						 $active71=null;
						 $removeprice51=null;
						 $removeprice15=null;
						 $removeprice57=null;
						 $removeprice71=null;
						 $removelocation=null;
						 $removelocation='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dlocation=1" class="rclose">remove</a>'; 
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['location']>0 and $_SESSION['filetrsarray']['location']==51){ $active51='class="active"';$removeprice51=$removelocation; }
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['location']>0 and $_SESSION['filetrsarray']['location']==15){ $active15='class="active"'; $removeprice15=$removelocation; }
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['location']>0 and $_SESSION['filetrsarray']['location']==57){ $active57='class="active"';$removeprice57=$removelocation; }
						 if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['location']>0 and $_SESSION['filetrsarray']['location']==71){ $active71='class="active"';$removeprice71=$removelocation; }
						 ?>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&location=51" <?php echo $active51; ?>>5-10 Miles</a> <?php echo $removeprice51; ?></label>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&location=15" <?php echo $active15; ?>>10-50 Miles</a> <?php echo $removeprice15; ?></label>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&location=57" <?php echo $active57; ?>>50-75 Miles</a> <?php echo $removeprice57; ?></label>
								<label class="checkbox"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&location=71" <?php echo $active71; ?>>75-100 Miles</a> <?php echo $removeprice71; ?></label>								
						 </div>
					 </div>
				 </section> 				 				 

		
			 </div>				 
	      </div>
		</div>
</div>	

