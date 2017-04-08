<?php
if(!Yii::$app->user->isGuest){
	$userinfo=app\modules\users\models\Userdetail::findOne(Yii::$app->user->id);
	$user_type=0;
	$user_type=$userinfo->user_type;
	
	$user_order=0;
	$orderinfo=app\models\OrderInfo::find()->Where(['user_id'=>Yii::$app->user->id]);		  
	if(count($orderinfo)>0) $user_order=1;
}
?>

<div class="top_bg">
	<div class="container">
		<div class="header_top-sec">
			<!-- nav -->
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				<div class="top_left">
				<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome" class="top-sellers">
					<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/whitelogo.png'); ?>" style="width: 100%;" alt="FuberMe"> 
				</a>
				</div>	
				</div>

				<?php 
				$append_url=null;								
				if(isset($_GET['directorder']) and ($_GET['directorder']>0)){
					$directorder=$_GET['directorder'];
					$append_url='&directorder='.$directorder;
				}
				?>	
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <nav class="cl-effect-13" id="cl-effect-13">
						<ul class="nav navbar-nav" style="width: 76%;">
										
						<?php 
						if(!Yii::$app->user->isGuest){	
						$url=Yii::$app->homeUrl.'?r=users/registration/update'; ?>					
	
								<li class="top_link dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<span class="glyphicon glyphicon-user"></span>
											<strong> &nbsp; 
											<?php echo Yii::$app->user->identity->username; ?>
											&nbsp; 
											</strong>
											<span class="glyphicon glyphicon-chevron-down"></span>
										</a>
										<ul class="dropdown-menu" style="min-width: 250px;" >
											<li>
												<div class="navbar-login">
													<div class="row">
														<div class="col-lg-4">
															<p class="text-center">
																<span class="glyphicon glyphicon-user icon-size" style="font-size: 35px;color: #38b662;"></span>
															</p>
														</div>
														<div class="col-lg-8">
															<p class="text-left"><strong><?php echo Yii::$app->user->identity->username; ?></strong></p>
														</div>
													</div>
												</div>
											</li>
											<li class="divider navbar-login-session-bg"></li>
											<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome">Eat with FuberMe <span class="glyphicon glyphicon-cutlery  pull-right"></span></a></li>
											<li class="divider"></li>	 									
											<?php 
											
/* 											$display=1;
											$display1=1;
											$userinfo=app\modules\users\models\Userdetail::findOne(Yii::$app->user->id);
											$user_type=0;
											$user_type=$userinfo->user_type;
											if(($user_type==2 or $user_type==3)){ ?>
												<?php
												if((Yii::$app->controller->action->id=='index') and (Yii::$app->controller->id=='orderinfo') and ($user_type==3)){
													$display=0;
												}
												if($display==1){ */
												if($user_type==2 or $user_type==3){
												?>
													<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/index">Received Orders <span class="glyphicon glyphicon-tasks pull-right"></span></a></li>
													<li class="divider"></li>
												<?php  } ?>			
											<?php // } ?>			
											
											<?php /*  if($user_type==1 or $user_type==3){ 
												
												if((Yii::$app->controller->action->id=='index2') and (Yii::$app->controller->id=='orderinfo') and ($user_type==3)){
													$display1=0;
												}

												if($display1==1){ */
												if($user_type==1 or $user_type==3 or $user_order==1){
											?>
												<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/index2">My Orders <span class="glyphicon glyphicon-list-alt pull-right"></span></a></li>
												<li class="divider"></li>
												<?php // } ?>		
											<?php  } ?>		
											
											<li><a href="<?php echo $url; ?>">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
											<li class="divider"></li>												
											<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/forgotpassword/changepass">Change Password <span class="	glyphicon glyphicon-lock pull-right"></span></a></li>
											<li class="divider"></li>										
											<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/login/logout">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
										</ul>
								</li>
	
						<?php }else{  ?>
								<?php 
								 if(Yii::$app->controller->action->id!='thanku'){ ?>
									<li class="top_link dropdown">
										<a href="#" class="dropdown-toggle" style="border: 1px solid white;" data-toggle="dropdown">Registration <b class="caret"></b></a>
										<ul class="dropdown-menu agile_short_dropdown">
											<li><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/registration">SignUp as a Chef <span class="glyphicon glyphicon-user  pull-right"></span></a></li>
											 <li class="divider"></li>		
											 <li><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/registration/cindex<?php echo $append_url; ?>">Eat with FuberMe <span class="glyphicon glyphicon-cutlery  pull-right"></span></a></li> 
										</ul>
									</li>	
								<?php } ?>									
								
								<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/login<?php echo $append_url; ?>">Login</a></li>							
								
						<?php } ?>
						
						<?php if(isset($_SESSION['order_array']['order_item']) and $_SESSION['order_array']['order_item']!=null){
								$item_id=0;
								$totla_item=0;
								$totla_item=count($_SESSION['order_array']['order_item']);
								foreach($_SESSION['order_array']['order_item'] as $item){
									$item_id=$item['item_id'];
									if($item_id>0) break;
								}
								
							?> 
						<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/review&itemid=<?php echo $item_id; ?>" class="yellowactive"><?php echo $totla_item; ?> Items &nbsp;<span class="glyphicon glyphicon-cutlery  pull-right"></span> </a></li>							
						<?php } ?>
						
						<?php 
						if(!Yii::$app->user->isGuest){
						if($user_type==2 or $user_type==3){
								$activeclass=null; if(Yii::$app->controller->id=='iteminfo' and Yii::$app->controller->action->id=='index') $activeclass='yellowactive';
						?>

							<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/index" class="<?php echo $activeclass; ?>">My Menu</a></li>	

						<?php  } ?>
						<?php  } ?>

						

						</ul>
						
					</nav>

				</div>
				<!-- /.navbar-collapse -->
			  </div>
			  <!-- /.container-fluid -->
			</nav> 
			<!-- //nav -->
				<div class="clearfix"> </div>
		</div>
	</div>
</div>

<?php 
/*
<!-- header -->
<div class="top_bg">
	<div class="container">
		<div class="header_top-sec">

			<div class="top_left">
				<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome" class="top-sellers">
				 <img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/whitelogo.png'); ?>" style="width: 100%;" alt="FuberMe">
				</a>			 
			</div>
			
			


			
			<?php 
			if(!Yii::$app->user->isGuest){
			if(Yii::$app->user->identity->user_type==2 or Yii::$app->user->identity->user_type==3){
					$activeclass=null; if(Yii::$app->controller->id=='iteminfo') $activeclass='yellowactive';
			?>
				<div class="top_right top_center">
					<ul>
						<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/index" class="<?php echo $activeclass; ?>">My Menu</a></li>	
					</ul>
				</div>
			<?php  } ?>
			<?php  } ?>



			
			
			
			<div class="top_right">
				<ul>
				
	<?php 	if(!Yii::$app->user->isGuest){
		
				$url=Yii::$app->homeUrl.'?r=users/registration/update';
	?>					
						<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome">Hungry?</a></li>
	
						<li class="top_link"><a href="<?php echo $url; ?>"> <span class="glyphicon glyphicon-cog"></span> <?php echo Yii::$app->user->identity->email_id; ?></a></li>				
					
						
						<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/login/logout">LOGOUT</a></li>				
					

			<?php }else{  ?>
						<?php 
						 if(Yii::$app->controller->action->id!='thanku'){ ?>
							<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/registration/cindex">Hungry?</a></li>	
							<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/registration">Start Cooking</a></li>		
						<?php } ?>		
						<li class="top_link"><a href="<?php echo Yii::$app->homeUrl; ?>?r=users/login">Login</a></li>							
			<?php } ?>
			
										
			

					
				</ul>
			</div>
				
				<div class="clearfix"> </div>
		</div>
	</div>
</div>


<?php 
*/


/*

<div class="header_top">
	 <div class="container">

		 <div class="header_right">	
			 <div class="login">
			 <?php 	if(Yii::$app->user->isGuest){ ?>
				<!-- <a href="<?php // echo Yii::$app->homeUrl; ?>?r=users/login">CHEF SIGN UP</a> -->
			 <?php }else{ ?>
				<a href="<?php echo Yii::$app->homeUrl; ?>?r=users/login/logout">LOGOUT</a>
			 <?php } ?>
				
			 </div>
			 <?php
/* 			 <div class="cart box_1">
				<a href="<?php echo Yii::$app->homeUrl; ?>?r=site/cart">
					<h3> <span class="simpleCart_total">$0.00</span> (<span id="simpleCart_quantity" class="simpleCart_quantity">0</span> items)</h3>
				</a>	
				<!-- <p><a href="javascript:;" class="simpleCart_empty">Empty cart</a></p> -->
				<div class="clearfix"> </div>
			 </div>	 
?>			 
		 </div>
		  <div class="clearfix"></div>	
	 </div>
</div>
*/
?>


<!--cart-->
	 
<!------>














<!--
<div class="mega_nav">
	 <div class="container">
		 <div class="menu_sec">
	
		 <ul class="megamenu skyblue">
			 <li class="active grid"><a class="color1" href="index.html">Home</a></li>
			 <li class="grid"><a class="color2" href="#">furniture</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Sofas</h4>
								<ul>
									<li><a href="products.html">All Sofas</a></li>
									<li><a href="products.html">Fabric Sofas</a></li>
									<li><a href="products.html">Leather Sofas</a></li>
									<li><a href="products.html">L-shaped Sofas</a></li>
									<li><a href="products.html">Love Seats</a></li>									
									<li><a href="products.html">Wooden Sofas</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Tables</h4>
								<ul>
									<li><a href="products.html">Coffee Tables</a></li>
									<li><a href="products.html">Dinning Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Wooden Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Bar & Unit Stools</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Beds</h4>
								<ul>
									<li><a href="products.html">Single Bed</a></li>
									<li><a href="products.html">Poster Bed</a></li>
									<li><a href="products.html">Sofa Cum Bed</a></li>
									<li><a href="products.html">Bunk Bed</a></li>
									<li><a href="products.html">King Size Bed</a></li>
									<li><a href="products.html">Metal Bed</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Seating</h4>
								<ul>
									<li><a href="products.html">Wing Chair</a></li>
									<li><a href="products.html">Accent Chair</a></li>
									<li><a href="products.html">Arm Chair</a></li>
									<li><a href="products.html">Mettal Chair</a></li>
									<li><a href="products.html">Folding Chair</a></li>
									<li><a href="products.html">Bean Bags</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Solid Woods</h4>
								<ul>
									<li><a href="products.html">Side Tables</a></li>
									<li><a href="products.html">T.v Units</a></li>
									<li><a href="products.html">Dressing Tables</a></li>
									<li><a href="products.html">Wardrobes</a></li>
									<li><a href="products.html">Shoe Racks</a></li>
									<li><a href="products.html">Console Tables</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
			<li><a class="color4" href="#">living</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Sofas</h4>
								<ul>
									<li><a href="products.html">All Sofas</a></li>
									<li><a href="products.html">Fabric Sofas</a></li>
									<li><a href="products.html">Leather Sofas</a></li>
									<li><a href="products.html">L-shaped Sofas</a></li>
									<li><a href="products.html">Love Seats</a></li>									
									<li><a href="products.html">Wooden Sofas</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Tables</h4>
								<ul>
									<li><a href="products.html">Coffee Tables</a></li>
									<li><a href="products.html">Dinning Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Wooden Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Bar & Unit Stools</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Beds</h4>
								<ul>
									<li><a href="products.html">Single Bed</a></li>
									<li><a href="products.html">Poster Bed</a></li>
									<li><a href="products.html">Sofa Cum Bed</a></li>
									<li><a href="products.html">Bunk Bed</a></li>
									<li><a href="products.html">King Size Bed</a></li>
									<li><a href="products.html">Metal Bed</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Seating</h4>
								<ul>
									<li><a href="products.html">Wing Chair</a></li>
									<li><a href="products.html">Accent Chair</a></li>
									<li><a href="products.html">Arm Chair</a></li>
									<li><a href="products.html">Mettal Chair</a></li>
									<li><a href="products.html">Folding Chair</a></li>
									<li><a href="products.html">Bean Bags</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Solid Woods</h4>
								<ul>
									<li><a href="products.html">Side Tables</a></li>
									<li><a href="products.html">T.v Units</a></li>
									<li><a href="products.html">Dressing Tables</a></li>
									<li><a href="products.html">Wardrobes</a></li>
									<li><a href="products.html">Shoe Racks</a></li>
									<li><a href="products.html">Console Tables</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>				
				<li><a class="color5" href="#">kitchen & dinning</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Sofas</h4>
								<ul>
									<li><a href="products.html">All Sofas</a></li>
									<li><a href="products.html">Fabric Sofas</a></li>
									<li><a href="products.html">Leather Sofas</a></li>
									<li><a href="products.html">L-shaped Sofas</a></li>
									<li><a href="products.html">Love Seats</a></li>									
									<li><a href="products.html">Wooden Sofas</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Tables</h4>
								<ul>
									<li><a href="products.html">Coffee Tables</a></li>
									<li><a href="products.html">Dinning Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Wooden Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Bar & Unit Stools</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Beds</h4>
								<ul>
									<li><a href="products.html">Single Bed</a></li>
									<li><a href="products.html">Poster Bed</a></li>
									<li><a href="products.html">Sofa Cum Bed</a></li>
									<li><a href="products.html">Bunk Bed</a></li>
									<li><a href="products.html">King Size Bed</a></li>
									<li><a href="products.html">Metal Bed</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Seating</h4>
								<ul>
									<li><a href="products.html">Wing Chair</a></li>
									<li><a href="products.html">Accent Chair</a></li>
									<li><a href="products.html">Arm Chair</a></li>
									<li><a href="products.html">Mettal Chair</a></li>
									<li><a href="products.html">Folding Chair</a></li>
									<li><a href="products.html">Bean Bags</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Solid Woods</h4>
								<ul>
									<li><a href="products.html">Side Tables</a></li>
									<li><a href="products.html">T.v Units</a></li>
									<li><a href="products.html">Dressing Tables</a></li>
									<li><a href="products.html">Wardrobes</a></li>
									<li><a href="products.html">Shoe Racks</a></li>
									<li><a href="products.html">Console Tables</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
				<li><a class="color6" href="#">appliances</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Sofas</h4>
								<ul>
									<li><a href="products.html">All Sofas</a></li>
									<li><a href="products.html">Fabric Sofas</a></li>
									<li><a href="products.html">Leather Sofas</a></li>
									<li><a href="products.html">L-shaped Sofas</a></li>
									<li><a href="products.html">Love Seats</a></li>									
									<li><a href="products.html">Wooden Sofas</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Tables</h4>
								<ul>
									<li><a href="products.html">Coffee Tables</a></li>
									<li><a href="products.html">Dinning Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Wooden Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Bar & Unit Stools</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Beds</h4>
								<ul>
									<li><a href="products.html">Single Bed</a></li>
									<li><a href="products.html">Poster Bed</a></li>
									<li><a href="products.html">Sofa Cum Bed</a></li>
									<li><a href="products.html">Bunk Bed</a></li>
									<li><a href="products.html">King Size Bed</a></li>
									<li><a href="products.html">Metal Bed</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Seating</h4>
								<ul>
									<li><a href="products.html">Wing Chair</a></li>
									<li><a href="products.html">Accent Chair</a></li>
									<li><a href="products.html">Arm Chair</a></li>
									<li><a href="products.html">Mettal Chair</a></li>
									<li><a href="products.html">Folding Chair</a></li>
									<li><a href="products.html">Bean Bags</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Solid Woods</h4>
								<ul>
									<li><a href="products.html">Side Tables</a></li>
									<li><a href="products.html">T.v Units</a></li>
									<li><a href="products.html">Dressing Tables</a></li>
									<li><a href="products.html">Wardrobes</a></li>
									<li><a href="products.html">Shoe Racks</a></li>
									<li><a href="products.html">Console Tables</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>				
			
				<li><a class="color7" href="#">decor</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Sofas</h4>
								<ul>
									<li><a href="products.html">All Sofas</a></li>
									<li><a href="products.html">Fabric Sofas</a></li>
									<li><a href="products.html">Leather Sofas</a></li>
									<li><a href="products.html">L-shaped Sofas</a></li>
									<li><a href="products.html">Love Seats</a></li>									
									<li><a href="products.html">Wooden Sofas</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Tables</h4>
								<ul>
									<li><a href="products.html">Coffee Tables</a></li>
									<li><a href="products.html">Dinning Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Wooden Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Bar & Unit Stools</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Beds</h4>
								<ul>
									<li><a href="products.html">Single Bed</a></li>
									<li><a href="products.html">Poster Bed</a></li>
									<li><a href="products.html">Sofa Cum Bed</a></li>
									<li><a href="products.html">Bunk Bed</a></li>
									<li><a href="products.html">King Size Bed</a></li>
									<li><a href="products.html">Metal Bed</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Seating</h4>
								<ul>
									<li><a href="products.html">Wing Chair</a></li>
									<li><a href="products.html">Accent Chair</a></li>
									<li><a href="products.html">Arm Chair</a></li>
									<li><a href="products.html">Mettal Chair</a></li>
									<li><a href="products.html">Folding Chair</a></li>
									<li><a href="products.html">Bean Bags</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Solid Woods</h4>
								<ul>
									<li><a href="products.html">Side Tables</a></li>
									<li><a href="products.html">T.v Units</a></li>
									<li><a href="products.html">Dressing Tables</a></li>
									<li><a href="products.html">Wardrobes</a></li>
									<li><a href="products.html">Shoe Racks</a></li>
									<li><a href="products.html">Console Tables</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>				
			
				<li><a class="color8" href="#">kids</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Sofas</h4>
								<ul>
									<li><a href="products.html">All Sofas</a></li>
									<li><a href="products.html">Fabric Sofas</a></li>
									<li><a href="products.html">Leather Sofas</a></li>
									<li><a href="products.html">L-shaped Sofas</a></li>
									<li><a href="products.html">Love Seats</a></li>									
									<li><a href="products.html">Wooden Sofas</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Tables</h4>
								<ul>
									<li><a href="products.html">Coffee Tables</a></li>
									<li><a href="products.html">Dinning Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Wooden Tables</a></li>
									<li><a href="products.html">Study Tables</a></li>
									<li><a href="products.html">Bar & Unit Stools</a></li>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Beds</h4>
								<ul>
									<li><a href="products.html">Single Bed</a></li>
									<li><a href="products.html">Poster Bed</a></li>
									<li><a href="products.html">Sofa Cum Bed</a></li>
									<li><a href="products.html">Bunk Bed</a></li>
									<li><a href="products.html">King Size Bed</a></li>
									<li><a href="products.html">Metal Bed</a></li>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Seating</h4>
								<ul>
									<li><a href="products.html">Wing Chair</a></li>
									<li><a href="products.html">Accent Chair</a></li>
									<li><a href="products.html">Arm Chair</a></li>
									<li><a href="products.html">Mettal Chair</a></li>
									<li><a href="products.html">Folding Chair</a></li>
									<li><a href="products.html">Bean Bags</a></li>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Solid Woods</h4>
								<ul>
									<li><a href="products.html">Side Tables</a></li>
									<li><a href="products.html">T.v Units</a></li>
									<li><a href="products.html">Dressing Tables</a></li>
									<li><a href="products.html">Wardrobes</a></li>
									<li><a href="products.html">Shoe Racks</a></li>
									<li><a href="products.html">Console Tables</a></li>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>				
			   </ul> 
			   <div class="search">
				 <form>
					<input type="text" value="" placeholder="Search...">
					<input type="submit" value="">
					</form>
			 </div>
			 <div class="clearfix"></div>
		 </div>
	  </div>
</div> -->
