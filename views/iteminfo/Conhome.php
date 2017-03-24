<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\Url;

?>

<style>

.list-view>.item{float:left;width: auto;padding: 0.5%;}

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



.pagination {
    display: none;
}


</style>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <style>
/*!
 * IE10 viewport hack for Surface/desktop Windows 8 bug
 * Copyright 2014-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/*
 * See the Getting Started docs for more information:
 * http://getbootstrap.com/getting-started/#support-ie10-width
 */
@-ms-viewport     { width: device-width; }
@-o-viewport      { width: device-width; }
@viewport         { width: device-width; }

    </style>
 
<style type="text/css">

body,html,.row-offcanvas {
  height:75%;
  position: fixed;
}

body {
  padding-top: 50px;
}

#sidebar {
  width: inherit;
  min-width: 220px;
  max-width: 220px;
  float: left;
  height:100%;
  position: relative;
  overflow-y:auto;
  overflow-x:hidden;
}
#main {
  height:100%;
  overflow:auto;
}

/*
 * off Canvas sidebar
 * --------------------------------------------------
 */
@media screen and (max-width: 768px) {
	
	body,html,.row-offcanvas {
	  height:80%;
	  position: relative;
	}


  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
    width:calc(100% + 220px);
  }
    
  .row-offcanvas-left
  {
    left: -220px;
  }

  .row-offcanvas-left.active {
    left: 0;
  }

  .sidebar-offcanvas {
    position: absolute;
    top: 0;
  }

}

.content {
   margin-top: 2%;
}

/* Not show scrollbar  */
::-webkit-scrollbar { 
    display: none; 
}
</style>

	
	
   <script>
	// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++
/*!
 * Copyright 2014-2015 Twitter, Inc.
 *
 * Licensed under the Creative Commons Attribution 3.0 Unported License. For
 * details, see https://creativecommons.org/licenses/by/3.0/.
 */
// Intended to prevent false-positive bug reports about Bootstrap not working properly in old versions of IE due to folks testing using IE's unreliable emulation modes.
(function () {
  'use strict';

  function emulatedIEMajorVersion() {
    var groups = /MSIE ([0-9.]+)/.exec(window.navigator.userAgent)
    if (groups === null) {
      return null
    }
    var ieVersionNum = parseInt(groups[1], 10)
    var ieMajorVersion = Math.floor(ieVersionNum)
    return ieMajorVersion
  }

  function actualNonEmulatedIEMajorVersion() {
    // Detects the actual version of IE in use, even if it's in an older-IE emulation mode.
    // IE JavaScript conditional compilation docs: https://msdn.microsoft.com/library/121hztk3%28v=vs.94%29.aspx
    // @cc_on docs: https://msdn.microsoft.com/library/8ka90k2e%28v=vs.94%29.aspx
    var jscriptVersion = new Function('/*@cc_on return @_jscript_version; @*/')() // jshint ignore:line
    if (jscriptVersion === undefined) {
      return 11 // IE11+ not in emulation mode
    }
    if (jscriptVersion < 9) {
      return 8 // IE8 (or lower; haven't tested on IE<8)
    }
    return jscriptVersion // IE9 or IE10 in any mode, or IE11 in non-IE11 mode
  }

  var ua = window.navigator.userAgent
  if (ua.indexOf('Opera') > -1 || ua.indexOf('Presto') > -1) {
    return // Opera, which might pretend to be IE
  }
  var emulated = emulatedIEMajorVersion()
  if (emulated === null) {
    return // Not IE
  }
  var nonEmulated = actualNonEmulatedIEMajorVersion()

  if (emulated !== nonEmulated) {
    window.alert('WARNING: You appear to be using IE' + nonEmulated + ' in IE' + emulated + ' emulation mode.\nIE emulation modes can behave significantly differently from ACTUAL older versions of IE.\nPLEASE DON\'T FILE BOOTSTRAP BUGS based on testing in IE emulation modes!')
  }
})();

	</script>

  
<!--  Slider css and js -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--  Slider css and js -->



  

<div class="product-model">	 
 <div class="container">

	<div class="row">
	  <div class="col-sm-3" style="padding: 0;">
		<h2 style="padding: 25px 0;float: left;">Order Your food</h2>	
	  </div>
	  <div class="col-sm-9" style="padding: 0;">
		  <div class="mega_nav" style="padding-top: 1%;">
			 <div style="width: 118%;">
				 <div class="menu_sec">
				 
					<form>
						
					   <input type="hidden" name="r" value="iteminfo/conhome">
					   <div class="search">				 
							<input type="text" name="search_by_item" value="<?php if(isset($_GET['search_by_item']) and ($_GET['search_by_item']!=null)){ echo $_GET['search_by_item']; } ?>" placeholder="Search Item...">
						</div>
						
					   <div class="search">
							<input type="text"  name="search_by_location"  value="<?php if(isset($_GET['search_by_location']) and ($_GET['search_by_location']!=null)){ echo $_GET['search_by_location']; } ?>" placeholder="Search By Location...">
						<input type="submit" value="">
						</div>
					
					</form>
							
			<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	  </div>
	</div>


</div>
</div>
<div class="row-offcanvas row-offcanvas-left">
  <div id="sidebar" class="sidebar-offcanvas">
     <div class="col-md-12">
	


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
				$delivery_type = Yii::$app->params['delivery_method']; 
				?> 
				<?php if(count($delivery_type)>0){ ?>							
					<section  class="sky-form">
						 <h4><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp; Delivery Type</h4>
						 <div class="row">
							 <div class="col col-4">							 
								 <?php 

								 foreach($delivery_type as $deliverykey=>$deliverytype){ 
								 if($deliverykey!='both'){
										$activecous=null;
										$removecous=null;
										$check_status=null;
										$delivery_types='delivery';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['delivery_array']!=null and in_array($deliverykey,$_SESSION['filetrsarray']['delivery_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&ddelivery='.$deliverykey.'" class="rclose">remove</a>';
											$check_status='checked';
											$delivery_types='ddelivery';
										} 
										

								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $delivery_types;  ?>=<?php echo $deliverykey; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $delivery_types;  ?>=<?php echo $deliverykey; ?>"  <?php echo $deliverytype; ?>><?php echo $deliverykey; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }
								 }
								 ?>	
								 
							 </div>
						 </div>
					 </section> 	
				<?php } ?>	
				
				
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
										$cusion_types='cusion';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['cusion_array']!=null and in_array($item_cuisine_type_info_id->id,$_SESSION['filetrsarray']['cusion_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcusion='.$item_cuisine_type_info_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$cusion_types='dcusion';
											$ccounter=$counter+1;
										} 
										if($counter<$ccounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_cuisine_type_info_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_cuisine_type_info_id']=$item_cuisine_type_info_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['cusion_types']=$cusion_types;
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
											$cusion_types=$collapse['cusion_types'];
											$check_status=$collapse['check_status'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_cuisine_type_info_id->name; ?></a>
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
										$dietary_types='dieta';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['dieta_array']!=null and in_array($item_dietary_preference_id->id,$_SESSION['filetrsarray']['dieta_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&ddieta='.$item_dietary_preference_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$dietary_types='ddieta';
											$dcounter=$counter+1;
										} 
										if($counter<$dcounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_dietary_preference_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_dietary_preference_id']=$item_dietary_preference_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['dietary_types']=$dietary_types;
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
											$dietary_types=$collapse['dietary_types'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_dietary_preference_id->name; ?></a>
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
										$categ_types='categ';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['categ_array']!=null and in_array($item_category_id->id,$_SESSION['filetrsarray']['categ_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcateg='.$item_category_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$categ_types='dcateg';
											$dcounter=$counter+1;
										} 
										if($counter<$dcounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_category_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_category_id']=$item_category_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['categ_types']=$categ_types;
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
											$categ_types=$collapse['categ_types'];
											$check_status=$collapse['check_status'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_category_id->name; ?></a>
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
	

      </div>
  </div>
  <div id="main">
      <div class="col-md-12">
      	  <p class="visible-xs">
            <button type="button" class="item_add items" data-toggle="offcanvas">Filters</button>
          </p>
			<?php	
				echo $this->render('conhomeitem', [
					'livedataProvider' => $livedataProvider,
					'offlinedataProvider' => $offlinedataProvider,
				]);				
			
			?>

      </div>
  </div>
</div><!--/row-offcanvas -->
  
  
  
<?php
/*
  
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
				$delivery_type = Yii::$app->params['delivery_method']; 
				?> 
				<?php if(count($delivery_type)>0){ ?>							
					<section  class="sky-form">
						 <h4><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp; Delivery Type</h4>
						 <div class="row">
							 <div class="col col-4">							 
								 <?php 

								 foreach($delivery_type as $deliverykey=>$deliverytype){ 
								 if($deliverykey!='both'){
										$activecous=null;
										$removecous=null;
										$check_status=null;
										$delivery_types='delivery';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['delivery_array']!=null and in_array($deliverykey,$_SESSION['filetrsarray']['delivery_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&ddelivery='.$deliverykey.'" class="rclose">remove</a>';
											$check_status='checked';
											$delivery_types='ddelivery';
										} 
										

								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $delivery_types;  ?>=<?php echo $deliverykey; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $delivery_types;  ?>=<?php echo $deliverykey; ?>"  <?php echo $deliverytype; ?>><?php echo $deliverykey; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }
								 }
								 ?>	
								 
							 </div>
						 </div>
					 </section> 	
				<?php } ?>	
				
				
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
										$cusion_types='cusion';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['cusion_array']!=null and in_array($item_cuisine_type_info_id->id,$_SESSION['filetrsarray']['cusion_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcusion='.$item_cuisine_type_info_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$cusion_types='dcusion';
											$ccounter=$counter+1;
										} 
										if($counter<$ccounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_cuisine_type_info_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_cuisine_type_info_id']=$item_cuisine_type_info_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['cusion_types']=$cusion_types;
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
											$cusion_types=$collapse['cusion_types'];
											$check_status=$collapse['check_status'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $cusion_types; ?>=<?php echo $item_cuisine_type_info_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_cuisine_type_info_id->name; ?></a>
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
										$dietary_types='dieta';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['dieta_array']!=null and in_array($item_dietary_preference_id->id,$_SESSION['filetrsarray']['dieta_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&ddieta='.$item_dietary_preference_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$dietary_types='ddieta';
											$dcounter=$counter+1;
										} 
										if($counter<$dcounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_dietary_preference_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_dietary_preference_id']=$item_dietary_preference_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['dietary_types']=$dietary_types;
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
											$dietary_types=$collapse['dietary_types'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $dietary_types; ?>=<?php echo $item_dietary_preference_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_dietary_preference_id->name; ?></a>
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
										$categ_types='categ';
										if(isset($_SESSION['filetrsarray']) and $_SESSION['filetrsarray']['categ_array']!=null and in_array($item_category_id->id,$_SESSION['filetrsarray']['categ_array'])){
											$activecous='class="active"';
											$removecous='<a href="'.Yii::$app->homeUrl.'?r=iteminfo/conhome&dcateg='.$item_category_id->id.'" class="rclose">remove</a>';
											$check_status='checked';
											$categ_types='dcateg';
											$dcounter=$counter+1;
										} 
										if($counter<$dcounter){
								 ?>	
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_category_id->name; ?></a>
										<?php echo $removecous; ?>
										</label>						 
								 <?php 
								 }else{
									 $collapse_array[$counter]['item_category_id']=$item_category_id;
									 $collapse_array[$counter]['activecous']=$activecous;
									 $collapse_array[$counter]['removecous']=$removecous;
									 $collapse_array[$counter]['categ_types']=$categ_types;
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
											$categ_types=$collapse['categ_types'];
											$check_status=$collapse['check_status'];
									?>
										<label class="checkbox">
										<input type="checkbox" <?php echo $check_status; ?> name="checkbox"  onclick='window.location.assign("<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>")'><i></i>
										<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome&<?php echo $categ_types; ?>=<?php echo $item_category_id->id; ?>"  <?php echo $activecous; ?>><?php echo $item_category_id->name; ?></a>
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

		
			 </div>				 
	      </div>
		</div>
		
		*/
		?>


<script type="text/javascript">

// infinite scroll 
var noresult = false;
var busy = false;
var limit = 5
var offset = 0;

function displayRecords(lim, off) {
        $.ajax({
          type: "GET",
          async: false,
          url: <?php Yii::$app->homeUrl; ?>'?r=iteminfo/conhome',
          data: "per-page=" + <?php echo Yii::$app->params['pagination_item_count']; ?> + "&page=" + off,
          cache: false,
          beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
          success: function(html) {
			//  alert(html);
            $("#results").append(html);
            $('#loader_image').hide();
            if (html == "") {
              $("#loader_message").html('<button data-atr="nodata" class="btn btn-default" type="button">No more records.</button>').show()
            } else {
              $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
            }
            window.busy = false;

          }
        });
}

$(document).ready(function() {

$(window).scroll(function() {
          // make sure u give the container id of the data to be loaded in.
          if ($(window).scrollTop() + $(window).height() > $("#results").height() && !busy) {
            busy = true;
       //     offset = limit + offset;
			offset=offset+1;
				
			if(!noresult){
				displayRecords(limit, offset);	
			}	
            

          }
});

});
// infinite scroll 
</script>



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
      values: [ 0, 100 ],
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
                    $('#main').html(response);
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
      values: [ 0, 100 ],
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
                    $('#main').html(response);
                },
            });
        }
    });
    $( "#location" ).val( "" + $( "#locationslider-range" ).slider( "values", 0 ) +
      "M - " + $( "#locationslider-range" ).slider( "values", 1 ) + "M" );
  } );
  </script>
  
  
<?php //unset($_SESSION['filetrsarray']); ?>





 <script>
	/*!
 * IE10 viewport hack for Surface/desktop Windows 8 bug
 * Copyright 2014-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

// See the Getting Started docs for more information:
// http://getbootstrap.com/getting-started/#support-ie10-width

(function () {
  'use strict';

  if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
      document.createTextNode(
        '@-ms-viewport{width:auto!important}'
      )
    )
    document.querySelector('head').appendChild(msViewportStyle)
  }

})();

	</script>
    <script>
	$(document).ready(function () {
  $('[data-toggle="offcanvas"]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
});
	</script>


