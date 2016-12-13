
<style>
.sofa-grid h4 a{
    background: #38b662;
	color: White;
	border-radius: 0;
}
</style>


<!---->
<!--  <div class="content">
	 <div class="container">
		 <div class="slider">
				<ul class="rslides" id="slider1">
				  <li><img src="../vendor/bower/fuberme/images/banner2.jpg" alt=""></li>
				  <li><img src="../vendor/bower/fuberme/images/banner1.jpg" alt=""></li>
				  <li><img src="../vendor/bower/fuberme/images/banner3.jpg" alt=""></li>
				</ul>
		 </div>
	 </div>
</div> -->
<!---->
<div class="bottom_content">
	 <div class="container">
			 <div class="col-md-12">
				<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/howitswork.jpg'); ?>" alt="How it works" style="width: 100%;"/>
			 </div>
		 <div class="sofas">

 <?php 	if(Yii::$app->user->isGuest){ ?>

			 <div class="col-md-6 sofa-grid">
<?php /*		 <img src="../vendor/bower/fuberme/images/t2.jpg" alt=""/>
				 <h3>SPECIAL Italian</h3> */ ?>
				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/registration/cindex" class="btn btn-success">HUNGRY ?</a></h4>
			 </div>
			 <div class="col-md-6 sofa-grid sofs">
<?php /*       <img src="../vendor/bower/fuberme/images/t1.jpg" alt=""/>
				 <h3>Special Indian Foods</h3> */ ?>
				 <h4><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/login" class="btn btn-success">START COOKING</a></h4>
			 </div>
			 
<?php } ?>
			 
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