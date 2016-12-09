<?php
use yii\helpers\Html;

?>

					<a href="#"><div class="product-grid love-grid">
						<div class="more-product"><span> </span></div>						
						<div class="product-img b-link-stripe b-animate-go  thickbox">
							<?php if($model->image==null){ ?>
								<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/default_item_image.jpg'); ?>"  alt="item image">
							<?php }else{ ?>
								<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/1/item_images/'.$model->image); ?>" alt="FuberMe">
							<?php } ?>
								
							<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
							<button class="btns"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Quick View</button>
							</h4>
							</div>
						</div></a>						
						<div class="product-info simpleCart_shelfItem">
							<div class="product-info-cust">
								<h4><?php echo $model->name; ?></h4>
								<p><?php if($model->delivery_method!='both') echo Yii::$app->params['delivery_method'][$model->delivery_method]; else echo 'Pickup,Home Delivery'; ?></p>
								<span class="item_price">$ <?php echo $model->price; ?></span>
								<br/>

								<?= yii\helpers\Html::a('<span class="glyphicon glyphicon-edit"></span>',['update','id'=>$model->id],['class'=>'item_add items','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Edit'] ) ?> 
								<?= yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>',['delete','id'=>$model->id], ['onclick' => 'return confirm("Are you sure you want to delete this '.$model->name.' ?");','class'=>'item_add items','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Delete']) ?>
								<?php
								if($model->status==1){  
								?>
								<?= yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-close"></span> Make Offline',['makeitemlive','id'=>$model->id],['class'=>'item_add items','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Make Offline']) ?>
								<?php }else{ ?>
								<?= yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span> Make Live','#',['class'=>'item_add items','data-toggle'=>'popover','data-title'=>'Select End Date','data-html'=>true,'data-placement'=>'right']) ?>
								<?php } ?>
							</div>													
							<div class="clearfix"> </div>
						</div>
					</div>

	<div id="popover-content" class="hide popfdsf">
	  <?php

	  echo Yii::$app->controller->renderPartial('get_enddate',['model' => $model],false,true); ?>	  
    </div>
		