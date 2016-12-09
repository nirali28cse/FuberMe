

<div class="mega_nav">
	 <div class="container">
		 <div class="menu_sec">

					 
			<?php
			
/* 			 <ul class="megamenu skyblue">
					<li  class="active grid"><a class="color1" href="<?php echo Yii::$app->homeUrl; ?>?r=users/default">Dashbord</a></li>				
					<li  class="grid"><a class="color1" href="<?php echo Yii::$app->homeUrl; ?>?r=cuisinetypeinfo/index">Cuisine Type Info</a></li>				
					<li  class="grid"><a class="color1" href="<?php echo Yii::$app->homeUrl; ?>?r=itemcategoryinfo/index">Category Info</a></li>				
					<li  class="grid"><a class="color1" href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/index">Item Info</a></li>				
			 </ul>  */
			
			if(Yii::$app->user->identity->is_admin){
				echo yii\widgets\Menu::widget([
					'options' => ['class' => 'megamenu skyblue'],
					'activeCssClass' => 'active',
					'items' => [
					//	['label' => 'Dashbord', 'url' => ['users/default']],
						// ['label' => 'Cuisine Type Info', 'url' => ['cuisinetypeinfo/index'], 'visible' => Yii::$app->user->isGuest],
						['label' => 'Cuisine Type', 'url' => [ '/cuisinetypeinfo/index'],'active'=>Yii::$app->controller->id=='cuisinetypeinfo'],
						['label' => 'Category', 'url' => ['/itemcategoryinfo/index'],'active'=>Yii::$app->controller->id=='itemcategoryinfo'],
						['label' => 'Dietary Preference', 'url' => ['/dietarypreference/index'],'active'=>Yii::$app->controller->id=='dietarypreference'],
					//	['label' => 'My Menu', 'url' => ['/iteminfo/index']],
					],
				]);
			}else{
				echo yii\widgets\Menu::widget([
					'options' => ['class' => 'megamenu skyblue'],
					'activeCssClass' => 'active',
					'items' => [
						['label' => 'My Menu', 'url' => ['/iteminfo/index'],'active'=>Yii::$app->controller->id=='iteminfo'],
					],
				]);
			}

			?>
			 
			 
			 <div class="clearfix"></div>
		 </div>
	  </div>
</div>
 <div class="clearfix"></div>
