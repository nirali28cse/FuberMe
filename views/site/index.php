
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
</style>

<?php 
use yii\widgets\ListView;

/* 

		$custom_exercise_letter='g';
	//	$selection_priority_array=array('a','b','c','d','e','f','g','h');
	//	$selection_priority_array=array('i','h','g','f','e','d','c','b','a');
		$selection_priority_array=array('b','a','g','f','e','d','c','i','h');
		$current_week=4;
		$swap_week=2;
		

		$selection_priority_array1=array();
		if((count($selection_priority_array)>0) and ($swap_week>0)){
		// rearrange selection priority array
				$couter=0;
				$selecount=0;
				$cha_array=array();				
				$selecount=count($selection_priority_array)*$swap_week;
				foreach($selection_priority_array as $selectionpriority){
					$cha_array[]=array_fill($couter,$swap_week,$selectionpriority);
					$couter=$couter+$swap_week;
				}
				
				$new_char_array=array();
				$notaddedfinal_char_array=array();

				$x = 1;		
				do {
					foreach($cha_array as $chkey=>$chavalue){
						foreach($chavalue as $key=>$value){			
							$new_char_array[$x]=$value;	
							$x++;	
							if($current_week>$selecount  and $x>$current_week){
								break 2;
							}		
						}
					}
				} while ($x <= $current_week); 

				$final_char_array=array();
				$added_first=0;
				$x1 = 1;	
				do {
					foreach($new_char_array as $key=>$value){	
						if(($key ==$current_week)){
							$final_char_array[$key]=$value;	
							$added_first=1;
							$x1++;	
						}elseif($added_first==1){
							$final_char_array[$key]=$value;	
							$x1++;	
						}else{
							$notaddedfinal_char_array[$key]=$value;	
							// $x1++;	
						}
					}
				} while ($x1 <= $current_week); 
				
				
			// rearrange selection priority array 
			// From current week rearrange array
			// $selection_priority_array1=array_merge($final_char_array,$notaddedfinal_char_array);
			
			$selection_priority_array1 = $final_char_array + $notaddedfinal_char_array;
		
			// depend on privious week selection chnage in array
			$finalselection_priority_array=array();
			$middel_array=array();
			$before_array=array();
			$after_array=array();
			$same_array=array();
			if(($selection_priority_array1!=null) and ($custom_exercise_letter!=null)){

				$current_index = array_search(strtolower($custom_exercise_letter), array_map('strtolower', $selection_priority_array1));
				if($swap_week>1){
					$swap_week1=$swap_week-1;
					$current_index=$current_index+$swap_week1;
				}

				$counter=0;
				foreach($selection_priority_array1 as $key2=>$value2){	
				
					if($key2==$current_index){
						$middel_array[$key2]=$value2;
						$counter=1;
					}elseif($counter==0){
						$before_array[$key2]=$value2;
					}elseif($counter==1){
						$after_array[$key2]=$value2;
					}
			
				}				
				$array_meged1 = $after_array + $before_array;
				$finalselection_priority_array = $array_meged1 + $middel_array;
				
			}else{
				$finalselection_priority_array = $selection_priority_array1;
			}
				
		}

		
		echo '<pre>';
		print_r($selection_priority_array);   // real array
		print_r($selection_priority_array1);  // change array depend on current week 
		print_r($finalselection_priority_array);  // change array depend on current week 
		
		exit;  */


?>


<style>

.list-view>.item{float:left; width:33.3%;}

.product-grid {
    width: 100%;
}


.sofa-grid h4 a{
    background: #38b662;
	color: White;
	border-radius: 0;
}
.itemerrorclass{
    font-size: 14px;
    color: #ff1414;
    margin: 95px 15px;
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
</style>

<script>
    // You can also use "$(window).load(function() {"
    $(function () {
      // Slideshow 1
      $("#slider1").responsiveSlides({
         auto: true,
		 nav: true,
		 speed: 500,
		 namespace: "callbacks",
      });
    });
  </script>
  
<!---->
 <div class="content">
	<!-- <div class="container"> -->
		 <div class="slider">
				<ul class="rslides" id="slider1">
				  <li><img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/1.jpg'); ?>" alt=""></li>
				  <li><img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/2.jpg'); ?>" alt=""></li>
				  <li><img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/3.jpg'); ?>" alt=""></li>
				  <li><img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/4.jpg'); ?>" alt=""></li>
				</ul>
				

		 </div>
	<!-- </div> -->
</div> 
<!---->
<div class="bottom_content">
	 <div class="container">
			 <div class="col-md-12">
				<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/howitswork.jpg'); ?>" alt="How it works" style="width: 100%;"/>
			 </div>
		 <div class="sofas">

 <?php 
 /* 
		$custom_exercise_letter=null;
		$custom_exercise_letter='a';
		$swap_week=1;
		$current_week=5;
		$selection_priority_array=['a','b','c','d','e','f','g','h','i'];
 		if(array_key_exists($custom_exercise_id,$taken_selection_priority)){
			$custom_exercise_letter=$taken_selection_priority[$custom_exercise_id];	
		} 
		
		$selection_priority_array1=array();
		if((count($selection_priority_array)>0) and ($swap_week>0)){
		// rearrange selection priority array
				$couter=0;
				$selecount=0;
				$cha_array=array();				
				$selecount=count($selection_priority_array)*$swap_week;
				foreach($selection_priority_array as $selectionpriority){
					$cha_array[]=array_fill($couter,$swap_week,$selectionpriority);
					$couter=$couter+$swap_week;
				}
				
				$new_char_array=array();
				$notaddedfinal_char_array=array();

				$x = 1;		
				do {
					foreach($cha_array as $chkey=>$chavalue){
						foreach($chavalue as $key=>$value){			
							$new_char_array[$x]=$value;	
							$x++;	
							if($current_week>$selecount  and $x>$current_week){
								break 2;
							}		
						}
					}
				} while ($x <= $current_week); 

				$final_char_array=array();
				$added_first=0;
				$x1 = 1;	
				do {
					foreach($new_char_array as $key=>$value){	
						if(($key ==$current_week)){
							$final_char_array[$key]=$value;	
							$added_first=1;
							$x1++;	
						}elseif($added_first==1){
							$final_char_array[$key]=$value;	
							$x1++;	
						}else{
							$notaddedfinal_char_array[$key]=$value;	
							// $x1++;	
						}
					}
				} while ($x1 <= $current_week); 
				
				
			// rearrange selection priority array 
			// From current week rearrange array
			$selection_priority_array1=array_merge($final_char_array,$notaddedfinal_char_array);
		
		
			// depend on privious week selection chnage in array
		 	$finalselection_priority_array=array();
			$middel_array=array();
			$before_array=array();
			$after_array=array();
			$same_array=array();
			if(($selection_priority_array1!=null) and ($custom_exercise_letter!=null)){
				$find_index = array_search(strtolower($custom_exercise_letter), array_map('strtolower', $selection_priority_array1));
				foreach($selection_priority_array1 as $key1=>$value1){	
				// $value1='b'; ,$custom_exercise_letter='f'; 
					//check $valuev > f
					if( (strcmp( strtolower( $value1 ), strtolower( $custom_exercise_letter ) ) > 0) and ($find_index>$key1) ){
							$middel_array[]=$value1;			
					}elseif($find_index>$key1){						
							$before_array[]=$value1;
					}elseif($find_index<$key1 and (strcasecmp($custom_exercise_letter, $value1) != 0)){						
							$after_array[]=$value1;
					}elseif((strcasecmp($custom_exercise_letter, $value1) == 0)){
							$same_array[]=$value1;
					}						
				}		
		
				// if privious selection priority is a then merge different way
				$find_index1 = array_search(strtolower($custom_exercise_letter), array_map('strtolower', $selection_priority_array));			
				if($find_index1==0){
					$array_meged1 = array_merge($after_array, $middel_array);
					$array_meged2 = array_merge($array_meged1, $same_array);
					$finalselection_priority_array = array_merge($array_meged2, $before_array);
				}else{
					$array_meged1 = array_merge($middel_array, $after_array);
					$array_meged2 = array_merge($array_meged1, $before_array);
					$finalselection_priority_array = array_merge($array_meged2, $same_array);
				}
				

			}else{
				$finalselection_priority_array = $selection_priority_array1;
			} 
				
		}

		
		echo '<pre>';
		print_r($selection_priority_array);   // real array
		print_r($selection_priority_array1);  // change array depend on current week 
		echo 'after_array';
		print_r($after_array);  // change array depend on current week 
		echo 'middel_array';
		print_r($middel_array);  // change array depend on current week 
		echo 'before_array';
		print_r($before_array);  // change array depend on current week 
		echo 'same_array';
		print_r($same_array);  // change array depend on current week 
		print_r($finalselection_priority_array); //change in array from privious week selection
		exit; */ 
 
 
/*		
 if(Yii::$app->user->isGuest){ ?>

			 <div class="col-md-6 sofa-grid">

				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/registration/cindex" class="btn btn-success">HUNGRY ?</a></h4>
			 </div>
			 <div class="col-md-6 sofa-grid sofs">

				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/login" class="btn btn-success">START COOKING</a></h4>
			 </div>
			 
<?php } */ ?>
			 
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>


<?php
/*
<!---->
<div class="new">
	 <div class="container">
		 <h3>Order Your Food</h3>
		 <div class="new-products">
		 <div class="new-items">
			 <div class="item1">
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/s1.jpg" alt=""/></a>
				 <div class="item-info">
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Nam sagittis</a></h4>
					 <span>Duis sit amet vehicula</span>
					 <a href="single.html">Order Now</a>
				 </div>
			 </div>
			 <div class="item4">
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/s4.jpg" alt=""/></a>
				  <div class="item-info4">
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Vivamus elementum</a></h4>
					 <span>Duis sit amet vehicula</span>
					 <a href="single.html">Order Now</a>
				 </div>			 
			 </div>
		 </div>
		 <div class="new-items new_middle">
			 <div class="item2">			 
				 <div class="item-info2">
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Interdum </a></h4>
					 <span>Duis sit amet vehicula</span>
					<a href="single.html">Order Now</a>
				 </div>
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/s2.jpg" alt=""/></a>
			 </div>
			 <div class="item5">	
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/s5.jpg" alt=""/></a>
				 <div class="item-info5">
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Ut purus</a></h4>
					 <span>Duis sit amet vehicula</span>
					 <a href="single.html">Order Now</a>
				 </div>	
			 </div>
		 </div>		  
		 <div class="new-items new_last">
			 <div class="item3">	
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/s3.jpg" alt=""/></a>
				 <div class="item-info3">
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Nam sagittis</a></h4>
					 <span>Duis sit amet vehicula</span>
					 <a href="single.html">Order Now</a>
				 </div>			 
			 </div>
			 <div class="item6">	
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/s6.jpg" alt=""/></a>
				 <div class="item-info6">
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Aenean quis</a></h4>
					 <span>Duis sit amet vehicula</span>
					 <a href="single.html">Order Now</a>
				 </div>
				 				 
			 </div>
		 </div>
		 <div class="clearfix"></div>	
		 </div>
	 </div>		 
</div>
<!---->
<div class="top-sellers">
	 <div class="container">
		 <h3>Special Dishes</h3>
		 <div class="seller-grids">
			 <div class="col-md-3 seller-grid">
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/ts2.jpg" alt=""/></a>
				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Duis sit amet vehicula</a></h4>
				<!--  <span>ID: DB4790</span> -->
				 <p>Rs. 25000/-</p>
			 </div>
			 <div class="col-md-3 seller-grid">
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/ts11.jpg" alt=""/></a>
				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Praesent id elit felis</a></h4>
				<!--  <span>ID: BR4822</span> -->
				 <p>Rs. 5000/-</p>
			 </div>
			 <div class="col-md-3 seller-grid">
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/ts3.jpg" alt=""/></a>
				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Integer eget aliquet</a></h4>
				<!--  <span>ID: BR4822</span> --> 
				 <p>Rs. 45000/-</p>
			 </div>
			 <div class="col-md-3 seller-grid">
				 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/ts4.jpg" alt=""/></a>
				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"> Vivamus quis lfsf </a></h4>
				<!--  <span>ID: DB4790</span> -->
				 <p>Rs. 18000/-</p>
			 </div>
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>
<!---->
<div class="recommendation">
	 <div class="container">
		 <div class="recmnd-head">
			 <h3>RECOMMENDATIONS FOR YOU</h3>
		 </div>
		 <div class="bikes-grids">			 
			 <ul id="flexiselDemo1">
				 <li>
					 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/ts1.jpg" alt=""/></a>	
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Curabitur sem orci</a></h4>	
					 <p>Duis sit amet vehicula</p>
				 </li>
				 <li>
					 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/r2.jpg" alt=""/></a>	
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Nullam at scelerisque</a></h4>	
					 <p>Duis sit amet vehicula</p>
				 </li>
				 <li>
					 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/r3.jpg" alt=""/></a>
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Ut purus nisi</a></h4>	
					 <p>Duis sit amet vehicula</p>
				 </li>
				 <li>
					 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/r4.jpg" alt=""/></a>
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">sollicitudin blandit</a></h4>	
					 <p>Duis sit amet vehicula</p>
				 </li>
				 <li>
					 <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products"><img src="../vendor/bower/fuberme/images/r5.jpg" alt=""/></a>	
					 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=site/products">Cras ante tortor</a></h4>	
					 <p>Duis sit amet vehicula</p>					 
				 </li>
		    </ul>
			<script type="text/javascript">
			 $(window).load(function() {			
			  $("#flexiselDemo1").flexisel({
				visibleItems: 5,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover:true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:640,
						visibleItems: 2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			});
			});
			</script>
				 
	 </div>
	 </div>
</div>
<!---->
*/
?>

<div class="mega_nav">
	 <div class="container">
		 <div class="menu_sec">
		 
			<form>
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

<br/>
<br/>
		
   <div class="product-model">	 
	 <div class="container">
		 <div class="col-md-12 product-model-sec">									
				<div class="item-info-index">
						<?php	

						
						        echo $this->render('/iteminfo/conhomeitem', [
									'livedataProvider' => $livedataProvider,
									'offlinedataProvider' => $offlinedataProvider,
								]);
								


						?>		
						
				</div>
			</div>
		</div>
	</div>
	
	
	

<script>
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