<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

?>
<style>




.list-view>.item{float:left; width:50%;}

bug_solve8
span.item_price {
    color: #38b662;
}

.product-info-cust {
    float: none;
}



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
.itemerrorclass{
    font-size: 14px;
    color: #ff1414;
    margin: 100px 15px;
    display: block;
    clear: both;
    position: absolute;
}


.items{
    float: left;
    margin: 0 0 16px 0px;
    display: block;
    clear: both;
}

.product-info.simpleCart_shelfItem {
    height: 160px;
    min-height: 160px;
}


.glyphicon-map-marker:before{
	    color: #38b662;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    border: 1px solid #38b662!important;
    background: #38b662!important;
}

.rsidebar{
	overflow: scroll;
    height: 500px;
}
.rsidebar::-webkit-scrollbar { 
    display: none; 
}

</style>


<!--  Slider css and js -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--  Slider css and js -->

  
  
  
<div class="product-model">	 
	 <div class="container">
		 
		<h2>Order Your food</h2>			
		 <div class="col-md-9 product-model-sec">
		 

						<?php	
							echo $this->render('conhomeitem', [
								'livedataProvider' => $livedataProvider,
								'offlinedataProvider' => $offlinedataProvider,
							]);				
						
						?>


		 </div>
			
			
			
			<div class="rsidebar span_1_of_left" id="fixed-floater">
				

				 <section  class="sky-form" style="border-top: 0px solid #eee;">
					 <h4><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
					 &nbsp; Price
						  <input type="text" id="amount" readonly style="border:0; color:#38b662;text-align: right;">
					 </h4>
					 <div class="row scroll-pane">
						 <div class="col col-4">
								 

						 
						<div id="pslider-range"></div>

						 </div>
					 </div>
				 </section> 
			
				 <section  class="sky-form">
					 <h4><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					 DISTANCE<input type="text" id="location" readonly style="border:0; color:#38b662;text-align: right;">
					 </h4>
					 <div class="row scroll-pane">
						 <div class="col col-4">
								 

						 
						<div id="locationslider-range"></div>

						 </div>
					 </div>
				 </section> 
			
			

				<?php 
				$item_cuisine_type_info_ids = app\models\CuisineTypeInfo::find()->where(['status'=>1])->all(); 
				?> 
				<?php if(count($item_cuisine_type_info_ids)>0){ ?>							
					<section  class="sky-form">
						 <h4><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>&nbsp; Cuisine</h4>
						 <div class="row">
							 <div class="col col-4">
							 
								 <?php 
								 $counter=1;
								 $ccounter=6;
								 $collapse_array=array();
								 foreach($item_cuisine_type_info_ids as $item_cuisine_type_info_id){ 
										$activecous=null;
										$removecous=null;
										$check_status=null;
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['cusion_array']!=null and in_array($item_cuisine_type_info_id->id,$_SESSION['filetrsarray']['cusion_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcusion='.$item_cuisine_type_info_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$ccounter=$counter+1;
										} 
										if($counter<$ccounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&cusion=<?php echo $item_cuisine_type_info_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&cusion=<?php echo $item_cuisine_type_info_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_cuisine_type_info_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_cuisine_type_info_id']=$item_cuisine_type_info_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['check_status']=$check_status;
								 }
								 $counter++;
								 }
								 ?>	

								<?php if(count($collapse_array)>0){ ?>
									   <div id="collapse1" class="panel-collapse collapse">
									<?php foreach($collapse_array as $collapse){ 
											$item_cuisine_type_info_id=$collapse['item_cuisine_type_info_id'];
											$activecous=$collapse['activecous'];
											$removecous=$collapse['removecous'];
											$check_status=$collapse['check_status'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&cusion=<?php echo $item_cuisine_type_info_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&cusion=<?php echo $item_cuisine_type_info_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_cuisine_type_info_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>										 
									<?php } ?>
									 </div>
									  <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" href="#collapse1">View More</a>
										</h4>
									  </div>
								<?php } ?>
								 
							 </div>
						 </div>
					 </section> 	
				<?php } ?>	


				<?php $item_dietary_preference_ids = app\models\DietaryPreference::find()->where(['status'=>1])->all(); ?> 
				<?php if(count($item_dietary_preference_ids)>0){ ?>							
					<section  class="sky-form">
						 <h4><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>&nbsp; Dietary Preference</h4>
						 <div class="row">
							 <div class="col col-4">
							 
								 <?php 

								 $counter=1;
								 $dcounter=6;
								 $collapse_array=array();
								 foreach($item_dietary_preference_ids as $item_dietary_preference_id){ 
										$activecous=null;
										$removecous=null;
										$check_status=null;
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['dieta_array']!=null and in_array($item_dietary_preference_id->id,$_SESSION['filetrsarray']['dieta_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&ddieta='.$item_dietary_preference_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$dcounter=$counter+1;
										} 
										if($counter<$dcounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&dieta=<?php echo $item_dietary_preference_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&dieta=<?php echo $item_dietary_preference_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_dietary_preference_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_dietary_preference_id']=$item_dietary_preference_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['check_status']=$check_status;
								 }
								 $counter++;
								 }
								 ?>	

								<?php if(count($collapse_array)>0){ ?>
									   <div id="collapse2" class="panel-collapse collapse">
									<?php foreach($collapse_array as $collapse){ 
											$item_dietary_preference_id=$collapse['item_dietary_preference_id'];
											$activecous=$collapse['activecous'];
											$removecous=$collapse['removecous'];
											$check_status=$collapse['check_status'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&dieta=<?php echo $item_dietary_preference_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&dieta=<?php echo $item_dietary_preference_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_dietary_preference_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>										 
									<?php } ?>
									 </div>
									  <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" href="#collapse2">View More</a>
										</h4>
									  </div>
								<?php } ?>
								 
							 </div>
						 </div>
					 </section> 	
				<?php } ?>	


				<?php $item_category_ids = app\models\ItemCategoryInfo::find()->where(['status'=>1])->all(); ?> 
				<?php if(count($item_category_ids)>0){ ?>							
					<section  class="sky-form">
						 <h4><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>&nbsp; Category</h4>
						 <div class="row">
							 <div class="col col-4">
							 
								 <?php 
								 $counter=1;
								 $dcounter=6;
								 $collapse_array=array();
								 foreach($item_category_ids as $item_category_id){ 
										$activecous=null;
										$removecous=null;
										$check_status=null;
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['categ_array']!=null and in_array($item_category_id->id,$_SESSION['filetrsarray']['categ_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcateg='.$item_category_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$dcounter=$counter+1;
										} 
										if($counter<$dcounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&categ=<?php echo $item_category_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&categ=<?php echo $item_category_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_category_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_category_id']=$item_category_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['check_status']=$check_status;
								 }
								 $counter++;
								 }
								 ?>	

								<?php if(count($collapse_array)>0){ ?>
									   <div id="collapse3" class="panel-collapse collapse">
									<?php foreach($collapse_array as $collapse){ 
											$item_category_id=$collapse['item_category_id'];
											$activecous=$collapse['activecous'];
											$removecous=$collapse['removecous'];
											$check_status=$collapse['check_status'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&categ=<?php echo $item_category_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&categ=<?php echo $item_category_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_category_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>										 
									<?php } ?>
									 </div>
									  <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" href="#collapse3">View More</a>
										</h4>
									  </div>
								<?php } ?>
								 
							 </div>
						 </div>
					 </section> 	
				<?php } ?>	






				
				<?php /*
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
				 */
				 /*
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
*/
		?>
		
		
			 </div>				 
	      </div>
		</div>
</div>	



 <script>
 
 

$('#collapse3,#collapse2,#collapse1').on('show.bs.collapse', function () {
       //call a service here 
	   var aid=$(this).attr("id");
	   $('a[href*="'+aid+'"]').text('View Less');
}); 

$('#collapse3,#collapse2,#collapse1').on('hide.bs.collapse', function () {
       //call a service here 
	    var aid=$(this).attr("id");
	   $('a[href*="'+aid+'"]').text('View More');
});  




 // price slider
  $( function() {
    $( "#pslider-range" ).slider({
      range: true,
      min: 0,
      max: 100,
      values: [ 20, 40 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      },
	stop: function( event, ui ) {
            var min_price = ui.values[ 0 ];
            var max_price = ui.values[ 1 ];
            $.ajax({
                type: "GET",
                data: "min_price="+min_price+"&max_price="+max_price,
                cache: false,
				success: function(response) {
                    $('.product-model-sec').html(response);
                },
            });
        }
    });
    $( "#amount" ).val( "$" + $( "#pslider-range" ).slider( "values", 0 ) +
      " - $" + $( "#pslider-range" ).slider( "values", 1 ) );
  } );
  </script>
  
  
 <script>
 // locationslider slider
  $( function() {
    $( "#locationslider-range" ).slider({
      range: true,
      min: 0,
      max: 100,
      values: [ 5, 50 ],
      slide: function( event, ui ) {
        $( "#location" ).val( "" + ui.values[ 0 ] + "M - " + ui.values[ 1 ] + "M" );
      },
	stop: function( event, ui ) {
            var min_location = ui.values[ 0 ];
            var max_location = ui.values[ 1 ];
            $.ajax({
                type: "GET",
                data: "min_location="+min_location+"&max_location="+max_location,
                cache: false,
				success: function(response){
                    $('.product-model-sec').html(response);
                },
            });
        }
    });
    $( "#location" ).val( "" + $( "#locationslider-range" ).slider( "values", 0 ) +
      "M - " + $( "#locationslider-range" ).slider( "values", 1 ) + "M" );
  } );
  </script>
  
  
<?php unset($_SESSION['filetrsarray']); ?>




<script>


function scrollFunction() {
    var scrollPos = document.body.scrollTop;
	// console.log(scrollPos);
     if (scrollPos > 1100) {
        document.getElementById("fixed-floater").style.position = "fixed";
        document.getElementById("fixed-floater").style.top = "100px";
        document.getElementById("fixed-floater").style.width = "18%";
    } else {
     //   document.getElementById("fixed-floater").style.position = "absolute";
   //    document.getElementById("fixed-floater").style.top = "50px";
    } 
}

window.onscroll = scrollFunction;

/* 
$(document).ready(function(){	

	$(document).on("click",".placeorder",function(e){		
		e.preventDefault();
		var oldHref = $(this).attr('href');
		var item_id=$(this).attr('id');
		$.ajax({			
			type: 'POST',
			url: <?php Yii::$app->homeUrl; ?>'?r=orderinfo/checkchef',
			data: {item_id:item_id},			
			error: function (err) {
			//	alert("error - " + err);
				return false;
			},
			success: function (data1) {
				// return false;
				// alert(data1);
				if(data1==0){	
					$('.itemerror'+item_id).html('Sorry,This item cannot be added.');
					return false;
				}else if(data1==3){	
					$('.itemerror'+item_id).html('Sorry,This item cannot be added,Due to less Qty.');
					return false;
				}else if(data1==4){	
					$('.itemerror'+item_id).html('Sorry,you can not purchase your own item.');
					return false;
				}else{					
					 window.location.href = oldHref; // go to the new url
				}				
			}
		});
	});
}); */


</script>